<?php

namespace App\Http\Controllers;

use App\Models\ExpenseItem;
use Illuminate\Http\Request;

class ExpenseItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'expense_group_id' => 'required|exists:expense_groups,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        ExpenseItem::create($request->validated());

        return redirect()->back()->with('success', 'Expense Item added successfully.');
    }
}
