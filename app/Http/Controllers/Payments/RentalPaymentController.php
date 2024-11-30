<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;
use Midtrans\Transaction;

class RentalPaymentController extends Controller
{
    private function getOrderDataById($id) {
        return  order::where('id', $id)->with('tenant')->with('car')->first();
    }
    public function payment_page(Request $request) {
        $orderId = $request->query('order_id');
        $orderData = $this->getOrderDataById($orderId);
        if($orderData->tenant->user_id != auth('web')->user()->id){
            return redirect()->back();
        }
        return view('Client.PaymentPage', [
            'user' => auth('web')->user(),
            'orderData' => $orderData,
            'snapToken' => $orderData->snap_token
        ]);
    }
    public function successPay(Request $request, $status) {
        $orderId = $request->query('order_id');
        if($status != 'success'){
            return redirect()->back()->withErrors([
                'errors' => 'This order payment failed'
            ]);
        }
        $orderData = order::where('id', $orderId)->with('tenant')->with('car')->first();
        if($orderData->tenant->user_id != auth('web')->user()->id){
            return redirect()->back()->withErrors([
                'errors' => 'this order data isnt found'
            ]);
        }
        $orderData->status = 'pending confirm';
        $orderData->save();
        return redirect()->route('dashboard.client');
    }
}
