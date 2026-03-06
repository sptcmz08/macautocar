<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refurbishment extends Model
{
    protected $fillable = ['car_id', 'name', 'amount'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
