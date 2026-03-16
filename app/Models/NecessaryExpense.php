<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NecessaryExpense extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'date',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
