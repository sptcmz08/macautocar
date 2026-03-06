<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Part;
use App\Models\Car;
use App\Models\Setting;

echo "--- Debugging Parts ---\n";
$parts = Part::all();
$partsValue = 0;
foreach ($parts as $part) {
    $val = $part->quantity * $part->unit_price;
    echo "Part: {$part->name}, Qty: {$part->quantity}, Price: {$part->unit_price}, Value: $val\n";
    $partsValue += $val;
}
echo "Total Parts Value: $partsValue\n";

echo "\n--- Debugging Cars ---\n";
$stockCars = Car::with('refurbishments')->where('status', 'stock')->get();
$stockCarsValue = $stockCars->sum(function ($car) {
    return $car->total_cost;
});
echo "Stock Cars Value: $stockCarsValue\n";

echo "\n--- Total Stock Value ---\n";
$totalStock = $stockCarsValue + $partsValue;
echo "Calculated Total Stock Value: $totalStock\n";

echo "\n--- Cash Calculation ---\n";
$setting = Setting::first();
$initial = $setting ? $setting->initial_capital : 0;
echo "Initial Capital: $initial\n";

// Re-simulate controller logic
$soldCars = Car::with('refurbishments')->where('status', 'sold')->get();
$totalSoldRevenue = $soldCars->sum('sold_price');
$totalSoldCost = $soldCars->sum(function ($car) {
    return $car->total_cost;
});
$accumulatedProfit = $totalSoldRevenue - $totalSoldCost;
echo "Accumulated Profit: $accumulatedProfit\n";

$cashOnHand = $initial + $accumulatedProfit - $totalStock;
echo "Calculated Cash On Hand: $cashOnHand\n";