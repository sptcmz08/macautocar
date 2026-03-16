<?php

namespace App\Http\Controllers;

use App\Models\PersonalTransaction;
use Illuminate\Http\Request;

class PersonalTransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
        ]);

        PersonalTransaction::create($request->validated());

        return redirect()->back()->with('success', 'บันทึกรายการเรียบร้อยแล้ว');
    }

    public function destroy(PersonalTransaction $personalTransaction)
    {
        $personalTransaction->delete();
        return redirect()->back()->with('success', 'ลบรายการเรียบร้อยแล้ว');
    }
}
