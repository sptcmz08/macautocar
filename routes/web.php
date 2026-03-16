<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RefurbishmentController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CapitalExpenseController;
use App\Http\Controllers\CapitalPaymentController;
use App\Http\Controllers\PersonalTransactionController;
use App\Http\Controllers\NecessaryExpenseController;
use App\Http\Controllers\BranchController;

// ============================================
// Auth Routes (Public)
// ============================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// Protected Routes (Require Login)
// ============================================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/daily-log', [DashboardController::class, 'dailyLog'])->name('daily-log');
    Route::post('/settings', [DashboardController::class, 'updateSetting'])->name('settings.update');
    Route::get('/profit-details', [DashboardController::class, 'profitDetails'])->name('profit.details');
    Route::get('/trash', [DashboardController::class, 'trash'])->name('trash');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
    Route::get('/stock-summary', [DashboardController::class, 'stockSummary'])->name('stock.summary');
    Route::get('/personal-account', [DashboardController::class, 'personalAccount'])->name('personal.account');

    // Restore routes
    Route::post('/cars/{id}/restore', [CarController::class, 'restore'])->name('cars.restore');
    Route::delete('/cars/{id}/force-delete', [CarController::class, 'forceDelete'])->name('cars.forceDelete');
    Route::post('/parts/{id}/restore', [PartController::class, 'restore'])->name('parts.restore');
    Route::delete('/parts/{id}/force-delete', [PartController::class, 'forceDelete'])->name('parts.forceDelete');

    // Car routes
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::post('/cars/{car}/sold', [CarController::class, 'markAsSold'])->name('cars.markAsSold');
    Route::post('/cars/{car}/revert-sold', [CarController::class, 'revertSold'])->name('cars.revertSold');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::post('/cars/check-license-plate', [CarController::class, 'checkLicensePlate'])->name('cars.checkLicensePlate');

    // Refurbishment routes
    Route::post('/cars/{car}/refurbishments', [RefurbishmentController::class, 'store'])->name('refurbishments.store');
    Route::delete('/refurbishments/{refurbishment}', [RefurbishmentController::class, 'destroy'])->name('refurbishments.destroy');

    // Car Image routes
    Route::delete('/car-images/{carImage}', [CarImageController::class, 'destroy'])->name('car-images.destroy');

    // Part routes
    Route::post('/parts/{part}/use', [PartController::class, 'usePart'])->name('parts.use');
    Route::resource('parts', PartController::class);

    // Capital Expense routes
    Route::resource('capital-expenses', CapitalExpenseController::class)->only(['show', 'store', 'update', 'destroy']);
    Route::post('/capital-expenses/{id}/sold', [CapitalExpenseController::class, 'markAsSold'])->name('capital-expenses.markAsSold');
    Route::post('/capital-expenses/{id}/revert-sold', [CapitalExpenseController::class, 'revertSold'])->name('capital-expenses.revertSold');

    // Capital Payment routes
    Route::post('/capital-expenses/{id}/payments', [CapitalPaymentController::class, 'store'])->name('capital-payments.store');
    Route::delete('/capital-payments/{id}', [CapitalPaymentController::class, 'destroy'])->name('capital-payments.destroy');

    // Personal Transaction routes
    Route::post('/personal-transactions', [PersonalTransactionController::class, 'store'])->name('personal-transactions.store');
    Route::delete('/personal-transactions/{personalTransaction}', [PersonalTransactionController::class, 'destroy'])->name('personal-transactions.destroy');

    // Necessary Expense routes
    Route::post('/necessary-expenses', [NecessaryExpenseController::class, 'store'])->name('necessary-expenses.store');
    Route::put('/necessary-expenses/{id}', [NecessaryExpenseController::class, 'update'])->name('necessary-expenses.update');
    Route::delete('/necessary-expenses/{id}', [NecessaryExpenseController::class, 'destroy'])->name('necessary-expenses.destroy');

    // Year-End Reset Routes
    Route::get('/year-end-reset', [DashboardController::class, 'showYearEndReset'])->name('year-end.show');
    Route::post('/year-end-reset', [DashboardController::class, 'executeYearEndReset'])->name('year-end.execute');
    Route::get('/reports/archive/{year}', [DashboardController::class, 'viewArchive'])->name('reports.archive');

    // Branch routes
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::put('/branches/{branch}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{branch}', [BranchController::class, 'destroy'])->name('branches.destroy');
    Route::post('/branches/order', [BranchController::class, 'updateOrder'])->name('branches.order');
    Route::put('/cars/{car}/branch', [BranchController::class, 'updateCarBranch'])->name('cars.updateBranch');

    // Serve storage files directly (bypass symlink for shared hosting)
    Route::get('/img/{path}', function ($path) {
        $basePath = realpath(storage_path('app/public'));
        $fullPath = realpath(storage_path('app/public/' . $path));

        // Prevent path traversal — resolved path must stay within storage/app/public/
        if (!$fullPath || !str_starts_with($fullPath, $basePath)) {
            abort(404);
        }

        if (!file_exists($fullPath)) {
            abort(404);
        }

        $mimeType = mime_content_type($fullPath);

        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    })->where('path', '.*')->name('storage.serve');

    // Setup route (requires login + local environment only)
    Route::get('/setup-macauto-2026', function () {
        if (!app()->environment('local')) {
            abort(403, 'Setup route is only available in local environment.');
        }

        try {
            $output = '<h2>🔧 Setup Helper</h2>';
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            $output .= '<p>✅ Config cleared</p>';
            \Illuminate\Support\Facades\Artisan::call('route:clear');
            $output .= '<p>✅ Route cleared</p>';
            \Illuminate\Support\Facades\Artisan::call('view:clear');
            $output .= '<p>✅ View cleared</p>';
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            $output .= '<p>✅ Cache cleared</p>';
            \Illuminate\Support\Facades\Artisan::call('migrate', ["--force" => true]);
            $output .= '<h3>📦 Migration Output:</h3><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
            return $output;
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });

});


