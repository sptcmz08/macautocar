<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = ['name', 'total_amount', 'description'];

    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class);
    }
}
