<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapitalExpense extends Model
{
    use SoftDeletes;

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
     * Get payments for this capital expense
     */
    public function payments()
    {
        return $this->hasMany(\App\Models\CapitalPayment::class);
    }

    /**
     * Get remaining amount
     * For parent records: original + sum(child increases) - sum(child decreases)
     */
    public function getRemainingAmountAttribute()
    {
        if ($this->transaction_type === 'decrease') {
            return $this->amount; // Decrease records don't have remaining
        }

        // For parent (increase) records:
        // + child increases (เพิ่มทุน)
        // - child decreases (ลดทุน/รับคืน)
        $childIncreases = $this->decreases()->where('transaction_type', 'increase')->sum('amount');
        $childDecreases = $this->decreases()->where('transaction_type', 'decrease')->sum('amount');
        return $this->amount + $childIncreases - $childDecreases;
    }
}


