<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapitalExpense extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'transaction_type',
        'date',
        'description',
        'image',
        'status',
        'sold_price',
        'sold_date',
        'parent_id',
    ];

    protected $casts = [
        'date' => 'date',
        'sold_date' => 'date',
    ];

    /**
     * Get parent expense (for decrease records)
     */
    public function parent()
    {
        return $this->belongsTo(CapitalExpense::class, 'parent_id');
    }

    /**
     * Get child decreases (for increase records)
     */
    public function decreases()
    {
        return $this->hasMany(CapitalExpense::class, 'parent_id');
    }

    /**
     * Get remaining amount (original - sum of decreases)
     */
    public function getRemainingAmountAttribute()
    {
        if ($this->transaction_type === 'decrease') {
            return $this->amount; // Decrease records don't have remaining
        }

        // For increase records: original amount - sum of decrease children
        $totalDecreases = $this->decreases()->sum('amount');
        return $this->amount - $totalDecreases;
    }
}

