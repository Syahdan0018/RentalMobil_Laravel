<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Car;
use App\Models\order;
use App\Models\PaymentService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use function React\Promise\all;

class RentController extends Controller
{
    public function render()
    {
        $tenant = Tenant::where("user_id", auth('web')->user()->id)->first();
        $cars = Car::where("regional_id", $tenant->regional_id)->get();

        return view("Client.RentPage", [
            'user' => auth('web')->user(),
            'cars' => $cars
        ]);
    }
    public function rent(Request $request)
    {
        $id = $request->query('id');
        $findCar = Car::where('id',$id)->first();
        return view('Client.RentDetail', [
            'user' => auth('web')->user(),
            'data' => $findCar
        ]);
    }
    public function confirm(Request $request)
    {
        $request->validate([
            'qty_unit' => 'required|integer|max:255|min:0|not_in:0',
            'driver_option' => 'string|required',
            'duration' => 'integer|required|min:0|not_in:0',
            'start_renting' => 'date|after_or_equal:today',
            'id' => 'integer|required'
        ]);
        // get tenant data
        $thistenant = Tenant::where('user_id', auth('web')->user()->id)->first();
        // validate user if user was renting car before
        $validateRenting = order::where('tenant_id', $thistenant->id)->orderBy('updated_at', 'asc')->get();
        $validatedStatus = $validateRenting->map(function ($data) {
            return $data->status;
        });
        if (!collect($validatedStatus)->every(function ($status){
            return in_array($status,['returned','canceled']);
        })) {
            return redirect()->back()->withErrors([
                'was_renting_before' => 'user telah merental mobil sebelumnya dan belum di return'
            ]);
        }

        // preparing data
        $id = $request->query('id');
        $cardetails = Car::where('id',$id)->first();
        $endrent = Carbon::createFromFormat('Y-m-d', $request->start_renting);
        $duration = (int)$request->duration;
        $endrent->addDays($duration);
        $endingrent = $endrent->format('Y-m-d');
        $driver = $request->driver_option == 'with' ? 'with_driver' : 'car_only';
        $driverprice = $driver == 'with_driver' ? 200000 : 0;

        // check if qty of car is null or less from 0
        if ($cardetails->number_of_car <= 0) {
            return redirect()->back()->withErrors([
                'car_is_null' => 'car was sold out'
            ]);
        }

        // validation , user can't rent car more than car qty
        if ($request->qty_unit > $cardetails->number_of_car) {
            return redirect()->back()->withErrors([
                'qty_unit' => "this car isn't available on this quantity unit"
            ]);
        }

        // equaling total price for this rent record
        $total_car_price = $this->calculatingTotalCarPrice($cardetails->price, $request->qty_unit, $request->duration);
        $total_driver_price = $this->calculatingTotalDriverPrice($driverprice, $request->qty_unit, $request->duration);
        $total_price = $this->calculatingTotalPriceWithDiscount($total_car_price, $total_driver_price, 0.0); // akan ditambahkan entity diskon

        // Prepare payment feature
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_price
            ),
            'customer_details' => array(
                'first_name' => auth('web')->user()->name,
                'email' => auth('web')->user()->email
            )
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // creating new order data
        $createorder = order::create([
            'tenant_id' => $thistenant->id,
            'car_id' => $cardetails->id,
            'status' => 'pending payment',
            'driver' => $driver,
            'start_rent' => $request->start_renting,
            'end_rent' => $endingrent,
            'duration' => $duration,
            'unit' => $request->qty_unit,
            'total_price' => $total_price,
            'snap_token' => $snapToken
        ]);

        // update quantity unit from car entity
        $cardetails->number_of_car = $cardetails->number_of_car - $request->qty_unit;
        $cardetails->save();

        return redirect()->route('rent.payment', ['order_id' => $createorder->id]);
    }
    private function calculatingTotalCarPrice($car_price, $quantity, $duration)
    {
        $total_car_price = $car_price * $quantity * $duration;
        return $total_car_price;
    }
    private function calculatingTotalDriverPrice($driver_price, $quantity, $duration)
    {
        $total_driver_price = $driver_price * $quantity * $duration;
        return $total_driver_price;
    }
    private function calculatingTotalPriceWithDiscount($total_car_price, $total_driver_price, float $discount_percentage = 0.0)
    {
        $discount = ($total_car_price + $total_driver_price) * $discount_percentage;
        $last_total_price = ($total_car_price + $total_driver_price) - $discount;
        return intval($last_total_price);
    }
    public function cancel(Request $request)
    {
        // get order record
        $orderid = $request->query('id');
        $orderdata = order::where('id', $orderid)->has('tenant')->with('tenant')->first();

        // check order record , it exist or not
        if (!$orderdata) {
            return redirect()->back()->withErrors([
                "doesntexist" => "this record isn't exists"
            ]);
        }

        // check if current order is belongs to user or not
        $currentuser = auth('web')->user();
        if ($orderdata->tenant->user_id != $currentuser->id) {
            return redirect()->back()->withErrors([
                "hah" => "this order record isn't belong this user"
            ]);
        }
        $carData = Car::where('id', $orderdata->car_id)->first();
        $carData->number_of_car = $carData->number_of_car + $orderdata->unit;
        // update order record
        $orderdata->status = 'canceled';
        $orderdata->save();

        return redirect()->back();
    }




    public function returning(Request $request)
    {
        // get order record data
        $orderid = $request->query('id');
        $orderdata = order::with('tenant')->where('id',$orderid)->first();

        //check if this order isn't belongs to current user
        if ($orderdata->tenant->user_id != auth('web')->user()->id) {
            return redirect()->back()->withErrors([
                'hah' => "this order record isn't belongs current user"
            ]);
        }
        //check if order record isn't exists
        if (!$orderdata) {
            return redirect()->back()->withErrors([
                'doesntexist' => 'this record order isnt exist'
            ]);
        }
        //update order data
        $orderdata->status = 'pending to return';
        $orderdata->save();

        //update qty of car
        $cardata = Car::where('id', $orderdata->car_id)->first();
        $cardata->number_of_car = $cardata->number_of_car + $orderdata->unit;
        $cardata->save();

        return redirect()->back();
    }
}
