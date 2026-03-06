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
        Schema::create('expense_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fund_id')->constrained()->cascadeOnDelete();
            $table->string('brand')->comment('ยี่ห้อ');
            $table->string('model')->comment('รุ่น');
            $table->string('year')->comment('ปี');
            $table->string('color')->comment('สี');
            $table->string('license_plate')->nullable()->comment('ทะเบียน');
            $table->date('purchase_date')->nullable()->comment('วันที่ซื้อ');
            $table->decimal('purchase_price', 15, 2)->default(0)->comment('ราคาซื้อ');
            $table->decimal('selling_price', 15, 2)->nullable()->comment('ราคาตั้งขาย');
            $table->string('status')->default('stock')->comment('สถานะ');
            $table->string('name')->nullable(); // Keep as optional or derived
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_groups');
    }
};
