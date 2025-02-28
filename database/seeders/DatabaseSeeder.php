<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class, 
            AdminSeeder::class, // ✅ Ajouté ici pour être exécuté avec db:seed
        ]);
    }
}