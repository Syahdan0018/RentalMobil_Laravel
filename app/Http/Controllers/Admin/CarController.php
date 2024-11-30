<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\operator;
use App\Models\regional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function render()
    {
        $user = auth('web')->user();
        $cars = Car::leftJoin('operators', 'operators.car_id', '=', 'cars.id')->where('operators.user_id', $user->id)->get();
        return view("Admin.CarList", [
            'user' => $user,
            'cars' => $cars
        ]);
    }
    public function createrender()
    {
        return view("Admin.CarAction", [
            'user' => auth('web')->user(),
            'regionals' => regional::all()
        ]);
    }
    public function create(Request $request)
    {
        $validated = $request->validate([
            'car_name' => 'required|min:1|max:255|string',
            'regional_id' => 'integer|required',
            'address' => 'required|max:512',
            'number_of_car' => 'required|integer|min:1',
            'price' => 'integer|required',
            'picture' => 'file|required'
        ]);

        $car = Car::create([
            'car_name' => $validated['car_name'],
            'regional_id' => $validated['regional_id'],
            'address' => $validated['address'],
            'number_of_car' => $validated['number_of_car'],
            'price' => $validated['price'],
            'picture' => $request->file('picture')
        ]);

        // get id from new car record
        $carid = $car->id;

        // save it into new operator record
        $thisoperator = auth('web')->user();
        operator::create([
            'car_id' => $carid,
            'user_id' => $thisoperator->id,
            'role' => 'administrator',
            'name' => $thisoperator->name
        ]);

        return redirect()->route('carlist.admin');
    }
    public function editrender($id)
    {
        $findCar = Car::has('operator')->has('regional')->where('id', $id)->with('regional')->with('operator')->first();
        if (!$findCar) {
            return redirect()->back();
        }
        if ($findCar->operator->user_id != auth('web')->user()->id) {
            return redirect()->back();
        }
        return view('Admin.EditCar', [
            'user' => auth('web')->user(),
            'regionals' => regional::all(),
            'car' => $findCar
        ]);
    }
    public function update(Request $request, $id)
    {
        // validate input from user
        $validated = $request->validate([
            'regional_id' => 'required|integer',
            'car_name' => 'required|string|max:255',
            'address' => 'required|string',
            'number_of_car' => 'required|integer',
            'price' => 'required|integer',
            'picture_act' => 'string|required',
            'picture' => 'nullable|file'
        ]);
        // if user choose to edit file but request file = null
        if ($validated['picture_act'] == 'edit' && !$request->hasFile('picture')) {
            return redirect()->back()->withErrors([
                'picture.required' => 'file is required when you choose to edit file'
            ]);
        }
        $findCar = Car::has('operator')->has('regional')->with('operator')->with('regional')->where('id', $id)->first();
        if (!$findCar) { // if not found the record , than redirect back
            return redirect()->back();
        }
        if ($findCar->operator->user_id !=  auth('web')->user()->id) { // if the car isn't own by this user , than redirect back
            return redirect()->back();
        }

        // edit data if user choose to editing file
        if ($validated['picture_act'] == 'edit') {
            $deletefile = Storage::delete($findCar->picture);
            $findCar->update([
                'regional_id' => $validated['regional_id'],
                'car_name' => $validated['car_name'],
                'address' => $validated['address'],
                'number_of_car' => $validated['number_of_car'],
                'price' => $validated['price'],
                'picture' => $request->file('picture')
            ]);
            $findCar->save();
            return redirect()->route('carlist.admin');
        }
        // edit data if user choose to keep file
        else if ($validated['picture_act'] == 'keep') {
            $findCar->update([
                'regional_id' => $validated['regional_id'],
                'car_name' => $validated['car_name'],
                'address' => $validated['address'],
                'number_of_car' => $validated['number_of_car'],
                'price' => $validated['price'],
            ]);
            $findCar->save();
            return redirect()->route('carlist.admin');
        }
        else {
            return redirect()->back()->withErrors([
                'update.failed' => 'update to this record is failed !'
            ]);
        }
    }
    public function delete(Request $request) {
        $id = $request->query('id');
        $car = Car::where('id',$id);
        $ha = Storage::disk('public')->delete($car->picture);
        $car->delete();
        return redirect()->back();
    }
}
