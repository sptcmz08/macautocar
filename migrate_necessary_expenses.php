<?php
/**
 * Browser-based migration: Create necessary_expenses table
 * วิธีใช้: upload ไฟล์นี้ไปที่ root ของเว็บ แล้วเปิดผ่าน browser
 * เสร็จแล้วให้ลบไฟล์นี้ทิ้งทันที
 */

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

echo "<h2>🔧 Migration: necessary_expenses</h2>";

try {
    if (Schema::hasTable('necessary_expenses')) {
        echo "<p>⚠️ ตาราง <code>necessary_expenses</code> มีอยู่แล้ว — ข้ามขั้นตอนนี้</p>";
    } else {
        Schema::create('necessary_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('รายการค่าใช้จ่าย');
            $table->decimal('amount', 15, 2)->comment('จำนวนเงิน');
            $table->date('date')->comment('วันที่');
            $table->text('description')->nullable()->comment('หมายเหตุ');
            $table->timestamps();
        });
        echo "<p>✅ สร้างตาราง <code>necessary_expenses</code> สำเร็จ!</p>";
    }

    echo "<hr><p style='color:red;'><strong>⚠️ กรุณาลบไฟล์ migrate_necessary_expenses.php ออกจาก server ทันทีหลังใช้งาน</strong></p>";
} catch (\Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}
