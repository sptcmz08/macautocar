<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'transmission',
        'license_plate',
        'purchase_date',
        'purchase_price',
        'refurbishment_cost',
        'selling_price',
        'status',
        'sold_date',
        'sold_price',
        'is_profit_stock',
        'branch_id',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'sold_date' => 'date',
        'is_profit_stock' => 'boolean',
    ];

    public function branch()
    {
        return $this->belongsTo(\App\Models\Branch::class);
    }

    public function refurbishments()
    {
        return $this->hasMany(Refurbishment::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    // Calculate total refurbishment cost dynamically
    public function getTotalRefurbishmentCostAttribute()
    {
        return $this->refurbishments->sum('amount');
    }

    // Calculate total cost (purchase + refurbishment)
    public function getTotalCostAttribute()
    {
        return $this->purchase_price + $this->total_refurbishment_cost;
    }
}
