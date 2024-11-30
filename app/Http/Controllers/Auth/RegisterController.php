<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\regional;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function render_page(Request $request)
    {
        $type = $request->query('type');
        $regionals = regional::all();
        // return $regionals;
        if ($type == 'admin' || $type == 'tenant') {
            return view('Auth.RegisterPage', [
                'regionals' => $regionals,
                'type' => $type
            ]);
        } else {
            return redirect()->route('login');
        }
    }
    public function registerSubmit(Request $request)
    {
        $type = $request->query('type');
        if ($type == 'tenant') {
            return $this->handleRegistration($request, 'tenant');
        } else if ($type == 'admin') {
            return $this->handleRegistration($request, 'admin');
        } else {
            return redirect()->back()->withErrors([
                'pesan_error' => 'Invalid request parameter'
            ]);
        }
    }
    private function handleRegistration(Request $request, string $role) {
        $validationRules = $this->getValidationRules($role);
        $request->validate($validationRules);

        if($this->isUserExists($request->username) || $this->isUserExistsEmail($request->email)) {
            return redirect()->back()->withErrors([
                'pesan_error' => 'User Already Exists'
            ]);
        }

        $userData = $this->createUser(
            $request->name,
            $request->email,
            $request->username,
            $request->password,
            $role,
            $request->file('avatar')
        );

        if(!$userData) {
            return redirect()->back()->withErrors([
                'pesan_error' => 'Failed to create User'
            ]);
        }

        if($role === 'tenant') {
            $tenantData = $this->createTenant($request, $userData->id, $userData->password);
            if(!$tenantData){
                return redirect()->back()->withErrors([
                    'pesan_error' => 'Failed to create tenant data'
                ]);
            }
        }

        return redirect()->route('login');
    }
    private function getValidationRules(string $role) {
        $commonRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:255',
            'avatar' => 'nullable|file|image'
        ];
        if($role === 'tenant'){
            $tenantRules = [
                'gender' => 'required|string|in:male,female',
                'born_date' => 'required|date',
                'regional' => 'required|integer',
                'address' => 'required|string'
            ];
            return array_merge($commonRules, $tenantRules);
        }
        return $commonRules;
    }
    private function isUserExists($username) {
        return User::where('username', $username)->exists();
    }
    private function isUserExistsEmail($email) {
        return User::where('email', $email)->exists();
    }
    private function createUser($name, $email, $username,$password,$role,$avatar = null) {
        $avatarPath = $avatar ? $this->uploadAvatar($avatar) : null;
        return User::create([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role' => $role === 'admin' ? 'Operator' : 'Tenant',
            'avatar' => $avatarPath
        ]);
    }
    private function createTenant($request, $userId, $password) {
        return Tenant::create([
            'id_card_number' => Str::random(16),
            'user_id' => $userId,
            'password' => $password,
            'name' => $request->name,
            'born_date' => $request->born_date,
            'gender' => $request->gender,
            'address' => $request->address,
            'regional_id' => $request->regional
        ]);
    }
    private function uploadAvatar($avatar) {
        $fileName = time() . '_' . $avatar->getClientOriginalName();
        return $avatar->storeAs('', $fileName,'public');
    }
}
