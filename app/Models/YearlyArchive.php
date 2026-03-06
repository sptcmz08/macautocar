<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearlyArchive extends Model
{
    protected $fillable = [
        'year',
        'initial_capital',
        'final_cash',
        'total_profit',
        'car_stock_value',
        'parts_value',
        'capital_expenses',
        'cars_sold_count',
        'cars_in_stock_count',
        'sold_cars_data',
        'transactions_data',
        'notes',
    ];

    protected $casts = [
        'sold_cars_data' => 'array',
        'transactions_data' => 'array',
        'initial_capital' => 'decimal:2',
        'final_cash' => 'decimal:2',
        'total_profit' => 'decimal:2',
        'car_stock_value' => 'decimal:2',
        'parts_value' => 'decimal:2',
        'capital_expenses' => 'decimal:2',
    ];
}
