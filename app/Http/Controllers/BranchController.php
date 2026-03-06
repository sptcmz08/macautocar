<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Car;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * List all branches
     */
    public function index()
    {
        $branches = Branch::orderBy('sort_order')->get();
        return view('branches.index', compact('branches'));
    }

    /**
     * Store a new branch
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
        ]);

        $maxOrder = Branch::max('sort_order') ?? 0;
        $validated['sort_order'] = $maxOrder + 1;

        Branch::create($validated);

        return redirect()->back()->with('success', 'เพิ่มสาขาสำเร็จ');
    }

    /**
     * Update a branch
     */
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7',
        ]);

        $branch->update($validated);

        return redirect()->back()->with('success', 'อัพเดทสาขาสำเร็จ');
    }

    /**
     * Delete a branch
     */
    public function destroy(Branch $branch)
    {
        // Set cars to null before deleting
        Car::where('branch_id', $branch->id)->update(['branch_id' => null]);
        $branch->delete();

        return redirect()->back()->with('success', 'ลบสาขาสำเร็จ');
    }

    /**
     * Update branch order
     */
    public function updateOrder(Request $request)
    {
        $orders = $request->input('orders', []);

        foreach ($orders as $id => $order) {
            Branch::where('id', $id)->update(['sort_order' => $order]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update car's branch
     */
    public function updateCarBranch(Request $request, Car $car)
    {
        $validated = $request->validate([
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        $car->update(['branch_id' => $validated['branch_id']]);

        return response()->json(['success' => true, 'branch' => $car->fresh()->branch]);
    }
}
