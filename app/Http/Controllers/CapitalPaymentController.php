<?php

namespace App\Http\Controllers;

use App\Models\CapitalExpense;
use App\Models\CapitalPayment;
use Illuminate\Http\Request;

class CapitalPaymentController extends Controller
{
    /**
     * Store a new payment for a capital expense
     */
    public function store(Request $request, $capitalExpenseId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_type' => 'required|in:principal,interest,other',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $expense = CapitalExpense::findOrFail($capitalExpenseId);

        // Validate that payment doesn't exceed remaining amount for principal
        if ($request->payment_type === 'principal') {
            $remaining = $expense->remaining_amount;
            if ($request->amount > $remaining) {
                return back()->withErrors(['amount' => 'จำนวนเงินเกินยอดคงเหลือ (฿' . number_format($remaining, 0) . ')']);
            }
        }

        $expense->payments()->create([
            'amount' => $request->amount,
            'payment_type' => $request->payment_type,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('dashboard')->with('success', 'บันทึกการรับชำระ ฿' . number_format($request->amount, 0) . ' เรียบร้อยแล้ว');
    }

    /**
     * Delete a payment record
     */
    public function destroy($id)
    {
        $payment = CapitalPayment::findOrFail($id);
        $payment->delete();

        return redirect()->route('dashboard')->with('success', 'ลบรายการรับชำระเรียบร้อยแล้ว');
    }
}
