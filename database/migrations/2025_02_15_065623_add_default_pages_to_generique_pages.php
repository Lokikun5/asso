<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // ✅ Ajout des pages par défaut
        DB::table('generique_pages')->insert([
            [
                'title' => 'Politique de Confidentialité',
                'meta_description' => 'Découvrez notre politique de confidentialité pour comprendre comment nous protégeons vos données personnelles.',
                'slug' => 'politique-de-confidentialite',
                'content' => "",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mentions Légales',
                'meta_description' => 'Informations légales sur notre site, nos obligations légales.',
                'slug' => 'mentions-legales',
                'content' => "",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        // ✅ Suppression des pages si la migration est annulée
        DB::table('generique_pages')->whereIn('slug', ['politique-de-confidentialite', 'mentions-legales'])->delete();
    }
};