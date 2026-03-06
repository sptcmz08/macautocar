<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    protected $fillable = ['expense_group_id', 'name', 'amount'];

    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class);
    }
}
