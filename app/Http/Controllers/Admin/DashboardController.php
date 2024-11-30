<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\operator;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function render () {
        $operator_data_with_car = operator::where('user_id', auth('web')->user()->id)->has('car')->with('car')->get();
        $profitdata = order::select(DB::raw('SUM(total_price) as total_price_sum'), DB::raw('SUBSTRING(end_rent,6,2) as month'))
                      ->where('status', 'returned')
                      ->whereIn('car_id', $operator_data_with_car->map(function($data) {
                        return $data->car->id;
                      }))
                      ->groupBy(DB::raw('SUBSTRING(end_rent,6,2)'))
                      ->get();

        return view('Admin.dashboardAdmin', [
            'user' => auth('web')->user(),
            'data' => order::has('car')->with('car')->get(),
            'profit' => $profitdata->values()
        ]);
    }
}
