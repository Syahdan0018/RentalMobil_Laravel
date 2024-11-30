<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class operator extends Model
{
    protected $table = "operators";
    protected $fillable = [
        'car_id',
        'user_id',
        'role',
        'name'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function car() {
        return $this->belongsTo(Car::class);
    }
}
