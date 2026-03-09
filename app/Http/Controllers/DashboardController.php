<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Setting;
use App\Models\Part;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Get or create initial settings
            $setting = Setting::first();
            if (!$setting) {
                $setting = Setting::create(['initial_capital' => 50000000, 'year' => 2569]);
            }

            // Fetch branches for sorting
            $branches = \App\Models\Branch::orderBy('sort_order')->get();

            // Get all cars with refurbishments, images, and branch - sorted by branch then date
            $cars = Car::with(['refurbishments', 'images', 'branch'])->orderBy('branch_id')->orderBy('created_at', 'desc')->get();

            // Calculate stats
            $stockCars = Car::with(['refurbishments', 'branch'])->where('status', 'stock')->orderBy('branch_id')->get();
            $soldCars = Car::with(['refurbishments', 'branch'])->where('status', 'sold')->get();

            // มูลค่าสต็อก = ราคาซื้อ + ค่าปรับสภาพ (dynamic from refurbishments)
            $stockCarsValue = $stockCars->sum(function ($car) {
                return $car->total_cost;
            });

            // มูลค่าอะไหล่ในสต็อก
            $parts = Part::orderBy('created_at', 'desc')->get();
            $partsValue = $parts->sum(function ($part) {
                return $part->quantity * $part->unit_price;
            });

            // Stock from Profit Logic
            $stockFromProfitCars = $stockCars->where('is_profit_stock', true);
            $stockFromProfitCount = $stockFromProfitCars->count();
            $stockFromProfitTotalCost = $stockFromProfitCars->sum('total_cost');

            // มูลค่าสต็อกรวม (รถ + อะไหล่) - Excluding Profit Stock if we don't want it to double count against Cash
            // However, Asset is Asset.
            // Let's Keep stockValue as Total.
            $stockValue = $stockCarsValue + $partsValue;

            // Fetch Capital Expenses
            $capitalExpenses = \App\Models\CapitalExpense::orderBy('date', 'desc')->get();
            $capitalExpensesTotal = $capitalExpenses->sum('amount');

            // คำนวณทุนอื่นๆ แบบใหม่:
            // - increase = เพิ่มทุน (เช่น ขายฝากที่ดิน) → หักจากเงินสด
            // - decrease = รับเงินคืน (เช่น เขาจ่ายเงินต้น) → เงินกลับมา
            $activeCapitalExpenses = $capitalExpenses->where('status', '!=', 'sold');
            $capitalIncreaseActive = $activeCapitalExpenses->where('transaction_type', 'increase')->sum('amount');
            $capitalDecreaseActive = $activeCapitalExpenses->where('transaction_type', 'decrease')->sum('amount');
            // ทุนอื่นๆ คงเหลือ = เพิ่มทุน - รับคืน (เฉพาะที่ยังไม่ปิดขาย)
            $capitalExpensesActiveTotal = $capitalIncreaseActive - $capitalDecreaseActive;

            // คำนวณกำไรจากทุนอื่นๆที่ปิดขายแล้ว
            // กำไร = ราคาขาย - ทุนคงเหลือ (หลังหักที่เขาจ่ายต้นมาแล้ว)
            $soldCapitalExpenses = $capitalExpenses->where('status', 'sold')->where('transaction_type', 'increase');
            $capitalExpensesProfit = $soldCapitalExpenses->sum(function ($expense) {
                return ($expense->sold_price ?? 0) - $expense->remaining_amount;
            });

            // Fetch Personal Transactions
            $personalTransactions = \App\Models\PersonalTransaction::orderBy('date', 'desc')->get();
            $personalIncome = $personalTransactions->where('type', 'income')->sum('amount');
            $personalExpense = $personalTransactions->where('type', 'expense')->sum('amount');
            $personalBalance = $personalIncome - $personalExpense;

            $totalSoldRevenue = $soldCars->sum('sold_price'); // รายได้จากการขาย
            $totalSoldCost = $soldCars->sum(function ($car) {
                return $car->total_cost;
            }); // ต้นทุนรถที่ขายไป

            // กำไรสะสม = กำไรขายรถ + กำไรจากทุนอื่นๆที่ปิดขายแล้ว
            $carProfit = $totalSoldRevenue - $totalSoldCost;
            $accumulatedProfit = $carProfit + $capitalExpensesProfit;

            // เงินสดในมือ = ทุนตั้งต้น + กำไรสะสม - สต็อกรถ - อะไหล่ - ทุนอื่นๆ (Active)
            $cashOnHand = $setting->initial_capital + $accumulatedProfit - $stockCarsValue - $partsValue - $capitalExpensesActiveTotal;

            // คำนวณค่าปรับสภาพรวม (สำหรับรถในสต็อก)
            $totalRefurbishmentCost = $stockCars->sum(function ($car) {
                return $car->total_refurbishment_cost;
            });

            $totalAssets = $setting->initial_capital + $accumulatedProfit; // สินทรัพย์รวม
            $carsInStock = $stockCars->count();

            // Prevent DivisionByZero: Default to 1,000,000 if null or 0
            $targetProfit = ($setting && $setting->target_profit > 0) ? $setting->target_profit : 1000000;
            $progressPercent = ($accumulatedProfit / $targetProfit) * 100;

            return view('dashboard', compact(
                'setting',
                'cars',
                'stockValue',
                'stockCarsValue',
                'partsValue',
                'cashOnHand',
                'accumulatedProfit',
                'totalAssets',
                'carsInStock',
                'parts',
                'capitalExpenses',
                'capitalExpensesTotal',
                'capitalExpensesActiveTotal',
                'personalTransactions',
                'personalIncome',
                'personalExpense',
                'personalBalance',
                'stockFromProfitCount',
                'stockFromProfitTotalCost',
                'targetProfit',
                'progressPercent',
                'totalRefurbishmentCost',
                'branches'
            ));
        } catch (\Exception $e) {
            dd($e->getMessage(), $e->getFile(), $e->getLine());
        }
    }

    public function personalAccount()
    {
        $personalTransactions = \App\Models\PersonalTransaction::orderBy('date', 'desc')->get();
        $personalIncome = $personalTransactions->where('type', 'income')->sum('amount');
        $personalExpense = $personalTransactions->where('type', 'expense')->sum('amount');
        $personalBalance = $personalIncome - $personalExpense;

        // Group by date
        $groupedByDate = $personalTransactions->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
        });

        return view('personal.index', compact(
            'personalTransactions',
            'personalIncome',
            'personalExpense',
            'personalBalance',
            'groupedByDate'
        ));
    }

    public function updateSetting(Request $request)
    {
        $request->validate([
            'initial_capital' => 'required|numeric|min:0',
            'year' => 'required|integer|min:2500',
            'target_profit' => 'nullable|numeric|min:0',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }
        $setting->initial_capital = $request->initial_capital;
        $setting->year = $request->year;
        if ($request->has('target_profit')) {
            $setting->target_profit = $request->target_profit;
        }
        $setting->save();

        return redirect()->route('dashboard')->with('success', 'บันทึกทุนตั้งต้นเรียบร้อยแล้ว');
    }

    public function profitDetails()
    {
        $soldCars = Car::with('refurbishments')->where('status', 'sold')->orderBy('sold_date', 'desc')->get();

        // Calculate totals
        $totalRevenue = $soldCars->sum('sold_price');
        $totalCost = $soldCars->sum(function ($car) {
            return $car->total_cost;
        });
        $totalProfit = $totalRevenue - $totalCost;
        $soldCount = $soldCars->count();
        $avgProfit = $soldCount > 0 ? $totalProfit / $soldCount : 0;

        // Monthly Profit for Graph
        $monthlyStats = $soldCars->groupBy(function ($car) {
            return $car->sold_date ? \Carbon\Carbon::parse($car->sold_date)->format('Y-m') : 'Unknown'; // Group by Year-Month
        })->map(function ($group) {
            $revenue = $group->sum('sold_price');
            $cost = $group->sum(function ($car) {
                return $car->total_cost;
            });
            return $revenue - $cost;
        })->sortKeys();

        // Prepare chart data
        $months = $monthlyStats->keys()->map(function ($m) {
            // Convert 2026-01 to Jan 2026 (Thai?) 
            // Simple approach: stick to Y-m or use array of Thai months
            return $m;
        });
        $profits = $monthlyStats->values();

        // Simulation: Reinvestment (Stock from Profit)
        // Assume avg cost per car is around 200,000 (just a guess or calc avg from stock/sold)
        // Let's use avg purchase price of sold cars as baseline
        $avgPurchasePrice = $soldCars->avg('purchase_price') ?: 200000;
        $potentialStockCount = $avgPurchasePrice > 0 ? floor($totalProfit / $avgPurchasePrice) : 0;

        // Target
        $setting = Setting::first();
        // Prevent DivisionByZero: Default to 1,000,000 if null or 0
        $targetProfit = ($setting && $setting->target_profit > 0) ? $setting->target_profit : 1000000;
        $progressPercent = ($totalProfit / $targetProfit) * 100;

        return view('profit.index', compact(
            'soldCars',
            'totalRevenue',
            'totalCost',
            'totalProfit',
            'soldCount',
            'avgProfit',
            'months',
            'profits',
            'potentialStockCount',
            'progressPercent',
            'targetProfit'
        ));
    }

    public function trash()
    {
        $deletedCars = Car::onlyTrashed()->with('refurbishments')->orderBy('deleted_at', 'desc')->get();
        $deletedParts = Part::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('trash.index', compact('deletedCars', 'deletedParts'));
    }

    public function reports()
    {
        // Get all sold cars for reports
        $soldCars = Car::with('refurbishments')->where('status', 'sold')->get();

        // Monthly data
        $monthlyData = $soldCars->groupBy(function ($car) {
            return $car->sold_date ? \Carbon\Carbon::parse($car->sold_date)->format('Y-m') : 'N/A';
        })->map(function ($group, $month) {
            $revenue = $group->sum('sold_price');
            $cost = $group->sum(function ($car) {
                return $car->total_cost;
            });
            return [
                'month' => $month,
                'count' => $group->count(),
                'revenue' => $revenue,
                'cost' => $cost,
                'profit' => $revenue - $cost
            ];
        })->sortKeys();

        // Yearly summary
        $yearlyData = $soldCars->groupBy(function ($car) {
            return $car->sold_date ? \Carbon\Carbon::parse($car->sold_date)->format('Y') : 'N/A';
        })->map(function ($group, $year) {
            $revenue = $group->sum('sold_price');
            $cost = $group->sum(function ($car) {
                return $car->total_cost;
            });
            return [
                'year' => $year,
                'count' => $group->count(),
                'revenue' => $revenue,
                'cost' => $cost,
                'profit' => $revenue - $cost
            ];
        })->sortKeys();

        // Capital Expenses for reports
        $capitalExpenses = \App\Models\CapitalExpense::orderBy('date', 'desc')->get();
        $capitalExpensesByMonth = $capitalExpenses->groupBy(function ($exp) {
            return $exp->date->format('Y-m');
        })->map(function ($group) {
            return $group->sum('amount');
        });

        return view('reports.index', compact('monthlyData', 'yearlyData', 'capitalExpensesByMonth'));
    }

    /**
     * Show Year-End Reset confirmation page
     */
    public function showYearEndReset()
    {
        $setting = Setting::first();

        // Get current year stats
        $stockCars = Car::with('refurbishments')->where('status', 'stock')->get();
        $soldCars = Car::with('refurbishments')->where('status', 'sold')->get();

        $stockCarsValue = $stockCars->sum(fn($car) => $car->total_cost);

        $parts = Part::all();
        $partsValue = $parts->sum(fn($part) => $part->quantity * $part->unit_price);

        // Capital Expenses — ใช้ logic เดียวกับ dashboard index
        $capitalExpenses = \App\Models\CapitalExpense::all();
        $activeCapitalExpenses = $capitalExpenses->where('status', '!=', 'sold');
        $capitalIncreaseActive = $activeCapitalExpenses->where('transaction_type', 'increase')->sum('amount');
        $capitalDecreaseActive = $activeCapitalExpenses->where('transaction_type', 'decrease')->sum('amount');
        $capitalExpensesActiveTotal = $capitalIncreaseActive - $capitalDecreaseActive;

        // กำไรจากทุนอื่นๆที่ปิดขายแล้ว
        $soldCapitalExpenses = $capitalExpenses->where('status', 'sold')->where('transaction_type', 'increase');
        $capitalExpensesProfit = $soldCapitalExpenses->sum(function ($expense) {
            return ($expense->sold_price ?? 0) - $expense->remaining_amount;
        });

        $totalSoldRevenue = $soldCars->sum('sold_price');
        $totalSoldCost = $soldCars->sum(fn($car) => $car->total_cost);
        $carProfit = $totalSoldRevenue - $totalSoldCost;
        $accumulatedProfit = $carProfit + $capitalExpensesProfit;

        $cashOnHand = $setting->initial_capital + $accumulatedProfit - $stockCarsValue - $partsValue - $capitalExpensesActiveTotal;

        $personalTransactions = \App\Models\PersonalTransaction::all();
        $personalBalance = $personalTransactions->where('type', 'income')->sum('amount')
            - $personalTransactions->where('type', 'expense')->sum('amount');

        // Get existing archives
        $archives = \App\Models\YearlyArchive::orderBy('year', 'desc')->get();

        // ส่ง capitalExpensesActiveTotal แทน capitalExpensesTotal
        $capitalExpensesTotal = $capitalExpensesActiveTotal;

        return view('year-end-reset', compact(
            'setting',
            'stockCars',
            'soldCars',
            'stockCarsValue',
            'partsValue',
            'capitalExpensesTotal',
            'accumulatedProfit',
            'cashOnHand',
            'personalBalance',
            'archives'
        ));
    }

    /**
     * Execute Year-End Reset
     */
    public function executeYearEndReset(Request $request)
    {
        $request->validate([
            'new_year' => 'required|integer|min:2024',
            'new_initial_capital' => 'required|numeric|min:0',
            'confirm_text' => 'required|in:RESET',
        ]);

        $setting = Setting::first();

        // Gather all current data for archive
        $stockCars = Car::with('refurbishments')->where('status', 'stock')->get();
        $soldCars = Car::with('refurbishments')->where('status', 'sold')->get();

        $stockCarsValue = $stockCars->sum(fn($car) => $car->total_cost);

        $parts = Part::all();
        $partsValue = $parts->sum(fn($part) => $part->quantity * $part->unit_price);

        // Capital Expenses — ใช้ logic เดียวกับ dashboard index
        $capitalExpenses = \App\Models\CapitalExpense::all();
        $activeCapitalExpenses = $capitalExpenses->where('status', '!=', 'sold');
        $capitalIncreaseActive = $activeCapitalExpenses->where('transaction_type', 'increase')->sum('amount');
        $capitalDecreaseActive = $activeCapitalExpenses->where('transaction_type', 'decrease')->sum('amount');
        $capitalExpensesActiveTotal = $capitalIncreaseActive - $capitalDecreaseActive;

        // กำไรจากทุนอื่นๆที่ปิดขายแล้ว
        $soldCapitalExpenses = $capitalExpenses->where('status', 'sold')->where('transaction_type', 'increase');
        $capitalExpensesProfit = $soldCapitalExpenses->sum(function ($expense) {
            return ($expense->sold_price ?? 0) - $expense->remaining_amount;
        });

        $totalSoldRevenue = $soldCars->sum('sold_price');
        $totalSoldCost = $soldCars->sum(fn($car) => $car->total_cost);
        $carProfit = $totalSoldRevenue - $totalSoldCost;
        $accumulatedProfit = $carProfit + $capitalExpensesProfit;

        $cashOnHand = $setting->initial_capital + $accumulatedProfit - $stockCarsValue - $partsValue - $capitalExpensesActiveTotal;

        // Prepare sold cars data for archive
        $soldCarsData = $soldCars->map(function ($car) {
            return [
                'id' => $car->id,
                'brand' => $car->brand,
                'model' => $car->model,
                'license_plate' => $car->license_plate,
                'purchase_price' => $car->purchase_price,
                'refurbishment_cost' => $car->total_refurbishment_cost,
                'total_cost' => $car->total_cost,
                'sold_price' => $car->sold_price,
                'profit' => $car->sold_price - $car->total_cost,
                'sold_date' => $car->sold_date?->format('Y-m-d'),
            ];
        })->toArray();

        // Prepare transactions data
        $personalTransactions = \App\Models\PersonalTransaction::all();
        $transactionsData = [
            'personal' => $personalTransactions->toArray(),
            'capital_expenses' => $capitalExpenses->toArray(),
        ];

        // Create archive record
        \App\Models\YearlyArchive::create([
            'year' => $setting->year,
            'initial_capital' => $setting->initial_capital,
            'final_cash' => $cashOnHand,
            'total_profit' => $accumulatedProfit,
            'car_stock_value' => $stockCarsValue,
            'parts_value' => $partsValue,
            'capital_expenses' => $capitalExpensesActiveTotal,
            'cars_sold_count' => $soldCars->count(),
            'cars_in_stock_count' => $stockCars->count(),
            'sold_cars_data' => $soldCarsData,
            'transactions_data' => $transactionsData,
            'notes' => $request->notes,
        ]);

        // Soft delete sold cars (move to archive)
        Car::where('status', 'sold')->delete();

        // Update settings for new year
        $setting->update([
            'year' => $request->new_year,
            'initial_capital' => $request->new_initial_capital,
        ]);

        return redirect()->route('dashboard')->with('success', 'Reset ปี ' . ($request->new_year - 1) . ' สำเร็จ! ยินดีต้อนรับสู่ปี ' . $request->new_year);
    }

    /**
     * View archived year data
     */
    public function viewArchive($year)
    {
        $archive = \App\Models\YearlyArchive::where('year', $year)->firstOrFail();

        return view('reports.archive', compact('archive'));
    }
}
