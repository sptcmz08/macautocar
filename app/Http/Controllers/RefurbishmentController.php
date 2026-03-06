<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Refurbishment;
use Illuminate\Http\Request;

class RefurbishmentController extends Controller
{
    public function store(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $car->refurbishments()->create([
            'name' => $request->name,
            'amount' => $request->amount,
        ]);

        return redirect()->route('dashboard')->with('success', 'เพิ่มรายการปรับสภาพเรียบร้อยแล้ว');
    }

    public function destroy(Refurbishment $refurbishment)
    {
        $refurbishment->delete();
        return redirect()->route('dashboard')->with('success', 'ลบรายการปรับสภาพเรียบร้อยแล้ว');
    }
}
