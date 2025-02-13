<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up(): void
    {
        DB::table('users')->insert([
            'name' => 'Eva Harmony GOZAN',
            'email' => 'gevaharmony@gmail.com',
            'password' => Hash::make('Passworduser123456'),
            'role' => 'super-admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('users')->where('email', 'gevaharmony@gmail.com')->delete();
    }
};