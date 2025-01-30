@extends('layouts.app')
@section('title', config('meta.target.title'))
@section('description', config('meta.target.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">🎯 Public Cible</h1>

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
            <div class="row mt-5">
                <!-- Jeunes élèves et étudiants -->
                <div class="col-md-4">
                    <div class="card text-center p-4 border rounded shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">🎓 Jeunes Élèves et Étudiants</h3>
                            <p class="card-text">
                                Collégiens, lycéens et universitaires en quête d’orientation et d’opportunités professionnelles.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Institutions -->
                <div class="col-md-4">
                    <div class="card text-center p-4 border rounded shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">🏫 Institutions</h3>
                            <p class="card-text">
                                Établissements scolaires, universités et services gouvernementaux désireux de renforcer l'accompagnement éducatif.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Entreprises -->
                <div class="col-md-4">
                    <div class="card text-center p-4 border rounded shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">🏢 Entreprises du Secteur Privé</h3>
                            <p class="card-text">
                                Acteurs des domaines de l’ingénierie, de l’informatique, de la médecine et des nouvelles technologies,
                                souhaitant contribuer à l’accompagnement des jeunes talents.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conclusion -->
            <p class="mt-5 text-center">
                🤝 Ensemble, inspirons des vocations et bâtissons des ponts entre savoir, expérience et ambition 
                pour façonner un avenir prometteur.
            </p>
        </div>
    </section>

    @include('layouts.footer')
@endsection
