<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations — Seed admin user.
     */
    public function up(): void
    {
        // Create admin user if not exists
        if (!User::where('name', 'admin')->exists()) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@macautocar.com',
                'password' => Hash::make('password'),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('name', 'admin')->delete();
    }
};
