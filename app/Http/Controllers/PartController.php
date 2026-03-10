<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartController extends Controller
{
    public function index()
    {
        $parts = \App\Models\Part::orderBy('created_at', 'desc')->get();
        // Get cars in stock for the dropdown
        $cars = \App\Models\Car::where('status', 'stock')->orderBy('created_at', 'desc')->get();
        return view('parts.index', compact('parts', 'cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:51200',
        ]);

        $data = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('part-images', 'public');
        }

        \App\Models\Part::create($data);

        return redirect()->route('dashboard', ['tab' => 'parts'])->with('success', 'เพิ่มอะไหล่เรียบร้อยแล้ว');
    }

    public function update(Request $request, \App\Models\Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:51200',
        ]);

        $data = [
            'name' => $request->name,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($part->image) {
                Storage::disk('public')->delete($part->image);
            }
            $data['image'] = $request->file('image')->store('part-images', 'public');
        }

        $part->update($data);

        return redirect()->route('dashboard', ['tab' => 'parts'])->with('success', 'อัปเดตอะไหล่เรียบร้อยแล้ว');
    }

    public function usePart(Request $request, \App\Models\Part $part)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'quantity' => 'required|integer|min:1|max:' . $part->quantity,
        ]);

        // Deduct stock
        $part->decrement('quantity', $request->quantity);

        // Add to car refurbishment cost
        $car = \App\Models\Car::find($request->car_id);
        $cost = $part->unit_price * $request->quantity;

        $car->refurbishments()->create([
            'name' => "ใช้อะไหล่: {$part->name} ({$request->quantity} ชิ้น)",
            'amount' => $cost
        ]);

        return redirect()->route('dashboard', ['tab' => 'parts'])->with('success', "บันทึกการใช้อะไหล่กับรถทะเบียน {$car->license_plate} เรียบร้อยแล้ว");
    }

    public function destroy(\App\Models\Part $part)
    {
        $part->delete();
        return redirect()->route('dashboard', ['tab' => 'parts'])->with('success', 'ลบอะไหล่เรียบร้อยแล้ว');
    }

    public function restore($id)
    {
        $part = \App\Models\Part::onlyTrashed()->findOrFail($id);
        $part->restore();
        return redirect()->route('trash')->with('success', 'กู้คืนอะไหล่ ' . $part->name . ' เรียบร้อยแล้ว');
    }

    public function forceDelete($id)
    {
        $part = \App\Models\Part::onlyTrashed()->findOrFail($id);
        if ($part->image) {
            Storage::disk('public')->delete($part->image);
        }
        $part->forceDelete();
        return redirect()->route('trash')->with('success', 'ลบอะไหล่ถาวรเรียบร้อยแล้ว');
    }
}
