<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';
    protected $fillable = [
        'id_card_number',
        'user_id',
        'password',
        'name',
        'born_date',
        'gender',
        'address',
        'regional_id'
    ];
    protected $hidden = [
        'password'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function order() {
        return $this->hasMany(order::class);
    }
}
