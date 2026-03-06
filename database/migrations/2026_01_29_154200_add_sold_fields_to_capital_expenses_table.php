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
        Schema::table('capital_expenses', function (Blueprint $table) {
            if (!Schema::hasColumn('capital_expenses', 'status')) {
                $table->string('status')->default('active')->after('description');
            }
            if (!Schema::hasColumn('capital_expenses', 'transaction_type')) {
                $table->string('transaction_type')->default('increase')->after('status');
            }
            if (!Schema::hasColumn('capital_expenses', 'sold_price')) {
                $table->decimal('sold_price', 15, 2)->nullable()->after('transaction_type');
            }
            if (!Schema::hasColumn('capital_expenses', 'sold_date')) {
                $table->date('sold_date')->nullable()->after('sold_price');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('capital_expenses', function (Blueprint $table) {
            $table->dropColumn(['status', 'transaction_type', 'sold_price', 'sold_date']);
        });
    }
};
