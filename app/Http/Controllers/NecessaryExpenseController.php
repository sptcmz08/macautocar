<?php

namespace App\Http\Controllers;

use App\Models\NecessaryExpense;
use Illuminate\Http\Request;

class NecessaryExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        NecessaryExpense::create($request->validated());

        return redirect()->route('dashboard')->with('success', 'บันทึกค่าใช้จ่ายเรียบร้อยแล้ว');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense = NecessaryExpense::findOrFail($id);
        $expense->update($request->validated());

        return redirect()->route('dashboard')->with('success', 'แก้ไขค่าใช้จ่ายเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $expense = NecessaryExpense::findOrFail($id);
        $expense->delete();

        return redirect()->route('dashboard')->with('success', 'ลบค่าใช้จ่ายเรียบร้อยแล้ว');
    }
}
