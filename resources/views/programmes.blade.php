@extends('layouts.app')
@section('title', config('meta.programmes.title'))
@section('description', config('meta.programmes.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Nos programmes', 'url' => route('programmes')]
        ];
    @endphp
    
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
  
    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">Nos programmes</h1>

            <p class="text-center">
                <strong>Le programme "Transfert Générationnel, la passerelle pour demain"</strong> 
                a pour objectif d’offrir aux jeunes hommes et femmes :
            </p>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-thumbtack"></i> Une orientation professionnelle</h3>
                        <ul>
                            <li>Orienter les jeunes dans leurs choix d’études et de carrière.</li>
                            <li>Permettre aux jeunes de mieux comprendre les opportunités et défis de différents métiers pour faire des choix éclairés.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-rocket"></i> Promouvoir des métiers d'avenir</h3>
                        <p>
                            Sensibiliser les jeunes africains aux métiers d'avenir dans les domaines technologiques, médicaux et techniques.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-graduation-cap"></i> L’Acquisition de compétences pratiques</h3>
                        <ul>
                            <li>Réduire l'écart entre les connaissances académiques et les exigences du marché de l'emploi.</li>
                            <li>Proposer des activités pour développer des compétences pratiques adaptées aux réalités professionnelles.</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-book"></i> L’Inclusion éducative</h3>
                        <p>Offrir ces opportunités à des jeunes issus de milieux diversifiés.</p>
                        <h4> La Création d’un Réseau de Soutien</h4>
                        <p>Favoriser l'accès à des réseaux professionnels et à des mentors.</p>
                    </div>
                </div>
            </div>

            <!-- Deuxième partie : Objectifs du programme féminin -->
            <h2 id="programme-feminin" class="text-center mt-5"><i class="fas fa-star"></i> Le Programme : "Lycéennes, étudiantes, osez et rêvez grand"</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-lightbulb"></i> Promouvoir des modèles féminins inspirants</h3>
                        <p>
                            Mettre en lumière des femmes leaders dans les secteurs de l’ingénierie, 
                            l’informatique, la médecine et les nouvelles technologies, afin de démontrer qu’il est 
                            possible de réussir et d’exceller dans ces professions.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-balance-scale"></i> Réduire les barrières structurelles et culturelles</h3>
                        <p>
                            Offrir un accompagnement personnalisé pour surmonter les obstacles liés aux stéréotypes du genre.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-book-open"></i> Renforcer les compétences et la confiance</h3>
                        <p>
                            Proposer des formations pratiques et des échanges enrichissants qui aident les jeunes femmes à se sentir légitimes et préparées.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-handshake"></i> Créer un réseau de soutien</h3>
                        <p>
                            Connecter les participantes avec des mentors, des pairs et des institutions engagées, 
                            pour les soutenir dans leurs parcours académiques et professionnels.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection