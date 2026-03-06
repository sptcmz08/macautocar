<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'color',
        'sort_order',
    ];

    /**
     * Get cars in this branch
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
