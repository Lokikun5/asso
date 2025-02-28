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
            ['name' => 'Formatrice et Mentore du Programme FORV'],
            ['name' => 'Formateur du Programme TGPD'],
            ['name' => 'Formatrice du Programme FORV'],
            ['name' => 'Mentor du Programme TGPD'],
            ['name' => 'Mentore du Programme FORV'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']], // Condition pour éviter les doublons
                $category
            );
        }
    }
}