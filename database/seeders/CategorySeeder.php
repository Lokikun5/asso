<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Formateur et Mentor du Programme TGPD'],
            ['name' => 'Formatrice et Mentore du Programme FORG'],
            ['name' => 'Formateur du Programme TGPD'],
            ['name' => 'Formatrice du Programme FORG'],
            ['name' => 'Mentor du Programme TGPD'],
            ['name' => 'Mentore du Programme FORG'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']], // Condition pour éviter les doublons
                $category
            );
        }
    }
}