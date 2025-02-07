<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultInstitutionPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('institution_partners')->insert([
            [
                'name' => 'Complexe Scolaire « LA SAGESSE »',
                'description' => 'Implanté à Lomé - Togo (Djidjolé) depuis plus de 20 ans, le complexe scolaire LA SAGESSE s’associe à notre initiative en tant que partenaire. Fidèle à son engagement de former les talents d’aujourd’hui, l’école ouvre désormais ses portes pour préparer ses élèves aux métiers de demain.',
                'category' => 'Ecoles et universités',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Entreprise « HEJAUS »',
                'description' => 'Implantée en France, HEJAUS est une entreprise innovante spécialisée dans la modélisation 3D, l’inspection, le diagnostic et le calcul de structures existantes.',
                'category' => 'Entreprises du secteur privé',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('institution_partners')->where('name', 'Complexe Scolaire « LA SAGESSE »')->delete();
        DB::table('institution_partners')->where('name', 'Entreprise « HEJAUS »')->delete();
    }
}