<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index()
    {
        $funds = Fund::all();
        return view('funds.index', compact('funds'));
    }

    public function create()
    {
        return view('funds.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Fund::create($request->all());

        return redirect()->route('funds.index')->with('success', 'Fund created successfully.');
    }

    public function show($id)
    {
        $fund = Fund::with('expenseGroups.expenseItems')->findOrFail($id);

        // Calculate totals
        $usedAmount = 0;
        foreach ($fund->expenseGroups as $group) {
            $groupTotal = $group->expenseItems->sum('amount');
            $group->total_cost = $groupTotal; // Attach property for view
            $usedAmount += $groupTotal;
        }

        $remainingAmount = $fund->total_amount - $usedAmount;

        return view('funds.show', compact('fund', 'usedAmount', 'remainingAmount'));
    }
}
