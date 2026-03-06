<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:10',
            'color' => 'required|string|max:50',
            'license_plate' => 'nullable|string|max:50|unique:cars,license_plate',
            'purchase_date' => 'required|date',
            'purchase_price' => 'required|numeric|min:0',
            'refurbishment_cost' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:51200', // Max 50MB per image
        ], [
            'license_plate.unique' => 'เลขทะเบียนนี้มีในระบบแล้ว',
            'required' => 'กรุณากรอกข้อมูล :attribute',
            'unique' => 'ข้อมูล :attribute ซ้ำในระบบ',
        ]);

        $car = Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'color' => $request->color,
            'transmission' => $request->transmission ?? 'M',
            'license_plate' => $request->license_plate,
            'purchase_date' => $request->purchase_date,
            'purchase_price' => $request->purchase_price,
            'refurbishment_cost' => $request->refurbishment_cost ?? 0,
            'selling_price' => $request->selling_price,
            'branch_id' => $request->branch_id ?: null,
            'notes' => $request->notes,
            'status' => 'stock',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('car-images', 'public');
                $car->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'เพิ่มรถเข้าสต็อกเรียบร้อยแล้ว');
    }

    public function show(Car $car)
    {
        $car->load('refurbishments');
        return view('cars.show', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'color' => 'nullable|string|max:50',
            'license_plate' => 'nullable|string|max:50|unique:cars,license_plate,' . $car->id,
            'purchase_date' => 'nullable|date',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|max:51200',
        ], [
            'license_plate.unique' => 'เลขทะเบียนนี้มีในระบบแล้ว',
        ]);

        $data = $request->only(['color', 'license_plate', 'purchase_date', 'purchase_price', 'selling_price', 'notes']);
        $data['branch_id'] = $request->branch_id ?: null;
        if ($request->has('transmission')) {
            $data['transmission'] = $request->transmission;
        }

        $car->update($data);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('car-images', 'public');
                $car->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'อัปเดตข้อมูลรถเรียบร้อยแล้ว');
    }

    public function markAsSold(Request $request, Car $car)
    {
        $soldPrice = $request->sold_price ?? $car->selling_price ?? $car->total_cost;

        $car->update([
            'status' => 'sold',
            'sold_date' => now(),
            'sold_price' => $soldPrice,
        ]);

        return redirect()->route('dashboard')->with('success', 'บันทึกการขายรถเรียบร้อยแล้ว');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('dashboard')->with('success', 'ลบข้อมูลรถเรียบร้อยแล้ว');
    }
    public function checkLicensePlate(Request $request)
    {
        $exists = Car::where('license_plate', $request->license_plate)
            ->when($request->exclude_id, function ($query, $id) {
                return $query->where('id', '!=', $id);
            })
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function restore($id)
    {
        $car = Car::onlyTrashed()->findOrFail($id);
        $car->restore();
        return redirect()->route('trash')->with('success', 'กู้คืนรถ ' . $car->brand . ' ' . $car->model . ' เรียบร้อยแล้ว');
    }

    public function forceDelete($id)
    {
        $car = Car::onlyTrashed()->findOrFail($id);
        // Also delete related images from storage
        foreach ($car->images as $image) {
            \Storage::disk('public')->delete($image->path);
            $image->forceDelete();
        }
        $car->refurbishments()->delete();
        $car->forceDelete();
        return redirect()->route('trash')->with('success', 'ลบถาวรเรียบร้อยแล้ว');
    }
}
