<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseGroup extends Model
{
    protected $fillable = [
        'fund_id',
        'brand',
        'model',
        'year',
        'color',
        'license_plate',
        'purchase_date',
        'purchase_price',
        'selling_price',
        'status',
        'name',
        'description'
    ];

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function expenseItems()
    {
        return $this->hasMany(ExpenseItem::class);
    }
}
