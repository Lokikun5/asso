@extends('layouts.app')
@section('title', config('meta.target.title'))
@section('description', config('meta.target.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Public Cible', 'url' => route('target')]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4"><i class="fas fa-bullseye"></i> Public cible</h1>

            <p class="text-center">
                Notre initiative s’adresse à un public varié, uni par une ambition commune :
                préparer la prochaine génération à réussir dans des domaines clés.
            </p>

            <p class="text-center">
                Que vous soyez un jeune en quête de repères, une institution éducative ou 
                une entreprise souhaitant transmettre son expertise, notre programme est conçu pour créer des passerelles entre ces acteurs 
                afin d’inspirer, guider et construire l’avenir ensemble.
            </p>

            <!-- Affichage en 3 colonnes -->
            <div class="row mt-5 g-4">
            <!-- Jeunes élèves et étudiants -->
            <div class="col-md-4 d-flex">
                <div class="p-4 border rounded shadow-sm flex-fill d-flex flex-column">
                    <h3><i class="fas fa-graduation-cap"></i> Jeunes Élèves et Étudiants</h3>
                    <p class="text-responsive">
                        Collégien(e)s, lycéen(ne)s et universitaires en quête d’orientation et d’opportunités professionnelles.
                    </p>
                </div>
            </div>

            <!-- Institutions -->
            <div class="col-md-4 d-flex">
                <div class="p-4 border rounded shadow-sm flex-fill d-flex flex-column">
                    <h3><i class="fas fa-school"></i> Institutions</h3>
                    <p class="text-responsive">
                        Établissements scolaires, universités et services gouvernementaux désireux de renforcer l'accompagnement éducatif.
                    </p>
                </div>
            </div>

            <!-- Entreprises -->
            <div class="col-md-4 d-flex">
                <div class="p-4 border rounded shadow-sm flex-fill d-flex flex-column">
                    <h3><i class="fas fa-building"></i> Organisme du secteur public</h3>
                    <p class="text-responsive">
                        Acteurs des domaines de l’ingénierie, de l’informatique, de la santé et des nouvelles technologies.
                       
                    </p>
                </div>
            </div>
        </div>


            <!-- Conclusion -->
            <p class="mt-5 text-center">
            <i class="fas fa-handshake"></i> Ensemble, inspirons des vocations et bâtissons des ponts entre savoir, expérience et ambition 
                pour façonner un avenir prometteur.
            </p>
        </div>
    </section>

    @include('layouts.footer')
@endsection
