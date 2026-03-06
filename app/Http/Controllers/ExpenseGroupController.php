<?php

namespace App\Http\Controllers;

use App\Models\ExpenseGroup;
use Illuminate\Http\Request;

class ExpenseGroupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'fund_id' => 'required|exists:funds,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:10',
            'color' => 'required|string|max:50',
            'license_plate' => 'nullable|string|max:50',
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        // Auto-generate a display name
        $name = "{$request->brand} {$request->model} ({$request->year}) - {$request->color}";

        ExpenseGroup::create(array_merge($request->all(), ['name' => $name]));

        return redirect()->back()->with('success', 'เพิ่มข้อมูลรถเรียบร้อยแล้ว');
    }
}
