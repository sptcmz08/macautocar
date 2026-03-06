<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapitalPayment extends Model
{
    protected $fillable = [
        'capital_expense_id',
        'amount',
        'payment_type',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function capitalExpense()
    {
        return $this->belongsTo(CapitalExpense::class);
    }
}
