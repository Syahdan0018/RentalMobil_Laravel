<?php

namespace App\Models;

use App\Events\updateOrderRecordEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'tenant_id',
        'car_id',
        'status',
        'driver',
        'start_rent',
        'end_rent',
        'duration',
        'unit',
        'total_price',
        // 'payment_service_id'
        'snap_token'
    ];
    public function car() {
        return $this->belongsTo(Car::class);
    }
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }
    // public function payment_service() {
    //     return $this->belongsTo(PaymentService::class, 'payment_service_id');
    // }
}
