<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('yearly_archives', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->decimal('initial_capital', 15, 2)->default(0);
            $table->decimal('final_cash', 15, 2)->default(0);
            $table->decimal('total_profit', 15, 2)->default(0);
            $table->decimal('car_stock_value', 15, 2)->default(0);
            $table->decimal('parts_value', 15, 2)->default(0);
            $table->decimal('capital_expenses', 15, 2)->default(0);
            $table->integer('cars_sold_count')->default(0);
            $table->integer('cars_in_stock_count')->default(0);
            $table->json('sold_cars_data')->nullable();
            $table->json('transactions_data')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yearly_archives');
    }
};
