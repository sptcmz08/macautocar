<?php

namespace App\Http\Controllers;

use App\Models\CapitalExpense;
use Illuminate\Http\Request;

class CapitalExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'transaction_type' => 'nullable|in:increase,decrease',
            'parent_id' => 'nullable|exists:capital_expenses,id',
            'image' => 'nullable|image|max:51200',
        ]);

        $data = [
            'name' => $request->name,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type ?? 'increase',
            'date' => $request->date,
            'description' => $request->description,
            'status' => 'active',
            'parent_id' => $request->parent_id,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('expense-images', 'public');
        }

        CapitalExpense::create($data);

        return redirect()->route('dashboard')->with('success', 'บันทึกรายการทุนอื่นๆ เรียบร้อยแล้ว');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_type' => 'nullable|in:increase,decrease',
            'image' => 'nullable|image|max:51200',
        ]);

        $expense = CapitalExpense::findOrFail($id);
        $data = [
            'name' => $request->name,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type ?? $expense->transaction_type,
            'date' => $request->date,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($expense->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($expense->image);
            }
            $data['image'] = $request->file('image')->store('expense-images', 'public');
        }

        $expense->update($data);

        return redirect()->route('dashboard')->with('success', 'แก้ไขรายการทุนเรียบร้อยแล้ว');
    }

    public function markAsSold(Request $request, $id)
    {
        $request->validate([
            'sold_price' => 'required|numeric|min:0',
        ]);

        $expense = CapitalExpense::findOrFail($id);
        $expense->update([
            'status' => 'sold',
            'sold_price' => $request->sold_price,
            'sold_date' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'ปิดขายรายการทุนเรียบร้อยแล้ว');
    }

    public function destroy(CapitalExpense $capitalExpense)
    {
        $capitalExpense->delete();
        return redirect()->route('dashboard')->with('success', 'ลบรายการเรียบร้อยแล้ว');
    }
}
