<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class regional extends Model
{
    protected $table = "regionals";
    protected $fillable = [
        'province',
        'district'
    ];
    public function tenant() {
        return $this->hasOne(Tenant::class);
    }
    public function car() {
        return $this->hasOne(Car::class);
    }
}
