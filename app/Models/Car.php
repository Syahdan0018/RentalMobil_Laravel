<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = [
        'regional_id',
        'car_name',
        'address',
        'number_of_car',
        'price',
        'picture',
    ];
    // mutate attribute of file
    public function setPictureAttribute($file) {
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('',$fileName,'public');
        $this->attributes['picture'] = $path;
    }
    public function order() {
        return $this->hasOne(order::class);
    }
    public function operator() {
        return $this->hasOne(operator::class);
    }
    public function regional() {
        return $this->belongsTo(regional::class);
    }
    public function discount () {
        return $this->hasOne(Discount::class);
    }
}
