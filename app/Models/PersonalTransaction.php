<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'name', // Description/Item name
        'amount',
        'type', // 'income' or 'expense'
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];
}
