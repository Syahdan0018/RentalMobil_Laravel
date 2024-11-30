<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\order;
use App\Models\Tenant;

class DashboardController extends Controller
{
    public function render () {

        // get authenticated tenant profile
        $iduser = auth('web')->user()->id;
        $thistenant = Tenant::where('user_id', $iduser)->first();

        // get car recomendation by authenticated tenant
        $rekomendasi = Car::where('regional_id', $thistenant->regional_id)->get();

        // get order and car from user where status = active / renting (status order feature)
        $statusrent = order::has('car') // where order has car record
                       ->with('car') // get car record
                       ->where('tenant_id', $thistenant->id) // where order.tenant_id is same with tenant that authenticated
                       ->orderBy('created_at', 'desc') // get latest record with latest created_at
                       ->first(); // get only 1 data that first of results


        // get history of order by tenant authenticated
        $history = order::has('car') // get order that has
                         ->with('car')
                         ->where('tenant_id', $thistenant->id)
                         ->orderBy('created_at', 'desc')
                         ->get();

        // total price = harga * unit * hari
        return view('Client/dashboardClient', [
            'user' => auth('web')->user(),
            'rekomendasi' => $rekomendasi,
            'status' => $statusrent ? $statusrent : null,
            'history' => $history
        ]);
    }
}
