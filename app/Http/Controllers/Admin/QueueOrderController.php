<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\operator;
use App\Models\order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueueOrderController extends Controller
{
    public function index() {
        // get current user and operator
        $user = auth('web')->user();
        $operator = operator::has('car')->with('car')->where('user_id', $user->id)->get();

        // get car id by mapping operator-car records
        $carid = $operator->map(function ($data) {
            return $data->car->id;
        });

        // get data order that relatable with operator records
        $order = order::with('tenant.user')->with('car')->whereIn('car_id', $carid)->orderBy('updated_at','desc')->get();
        return view('Admin.OrderQueue', [
            'datas' => $order,
            'user' => auth('web')->user(),
        ]);
    }
    public function confirm(Request $request) {
        // get order record details
        $orderid = $request->query('id');
        $orderdata = order::with('car.operator.user')->where('id',$orderid)->first();

        // validation this order is has this user or not
        $currentuser = auth('web')->user();
        if($orderdata->car->operator->user->id != $currentuser->id){
            return redirect()->back();
        }
        $orderdata->status = 'confirmed';
        $orderdata->save();

        return redirect()->back();
    }
    public function confirmToReturn(Request $request) {
        // get order data by request query id
        $orderid = $request->query('id');
        $orderdata = order::with('car.operator')->where('id',$orderid)->first();

        // validation this order , is belongs current user or not
        $currentuser = auth('web')->user();
        if($orderdata->car->operator->user->id != $currentuser->id){
            return redirect()->back();
        }
        $orderdata->status = "returned";

        $carData = Car::where('id', $orderdata->car->id)->first();
        $carData->number_of_car = $carData->number_of_car + $orderdata->unit;
        $orderdata->save();

        return redirect()->back();
    }
    public function orderStatusRenting(Request $request) {
        $orderData = order::where('id', $request->query('id'))->with('car.operator')->first();
        if($orderData->car->operator->user_id != auth('web')->user()->id) {
            return redirect()->back()->withErrors([
                'errors' => 'This order isnt belong this user'
            ]);
        }
        $orderData->status = 'renting';
        $orderData->save();
        return redirect()->back();
    }
}
