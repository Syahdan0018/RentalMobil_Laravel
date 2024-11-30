<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function render() {
        if(auth('web')->check()) {
            return redirect()->route('dashboard.admin');
        }
        $car = Car::all();
        return view('LandingPage', [
            'cars' => $car
        ]);
    }
}
