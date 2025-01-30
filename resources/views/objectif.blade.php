@extends('layouts.app')
@section('title', config('meta.objectif.title'))
@section('description', config('meta.objectif.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">Nos Objectifs</h1>

            <p class="text-center">
                <strong>Le Programme "Transfert Générationnel, la Passerelle pour Demain"</strong> 
                a pour objectif d’offrir aux jeunes hommes et femmes :
            </p>

            <!-- Utilisation d'un accordéon pour organiser les sections -->
            <div class="accordion" id="objectifAccordion">

                <!-- Orientation Professionnelle -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            📌 Une Orientation Professionnelle
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#objectifAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Orienter les jeunes dans leurs choix d’études et de carrière.</li>
                                <li>Permettre aux jeunes de mieux comprendre les opportunités et défis de différents métiers pour faire des choix éclairés.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Promouvoir des métiers d'avenir -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            🚀 Promouvoir des Métiers d'Avenir
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#objectifAccordion">
                        <div class="accordion-body">
                            <p>
                                Sensibiliser les jeunes africains aux métiers d'avenir dans les domaines technologiques, médicaux et techniques.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Acquisition de compétences pratiques -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            🎓 L’Acquisition de Compétences Pratiques
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#objectifAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Réduire l'écart entre les connaissances académiques et les exigences du marché de l'emploi.</li>
                                <li>Proposer des activités pour développer des compétences pratiques adaptées aux réalités professionnelles.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Inclusion éducative -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            📚 L’Inclusion Éducative
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#objectifAccordion">
                        <div class="accordion-body">
                            <p>Offrir ces opportunités à des jeunes issus de milieux diversifiés.</p>
                        </div>
                    </div>
                </div>

                <!-- Réseau de soutien -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            🤝 La Création d’un Réseau de Soutien
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#objectifAccordion">
                        <div class="accordion-body">
                            <p>Favoriser l'accès à des réseaux professionnels et à des mentors.</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Deuxième partie : Objectifs du programme féminin -->
            <h2 class="text-center mt-5">🌟 Le Programme : "Lycéennes, étudiantes, Osez et Rêvez Grand"</h2>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3>💡 Promouvoir des Modèles Féminins Inspirants</h3>
                        <p>
                            Mettre en lumière des femmes leaders dans les secteurs de l’ingénierie, 
                            l’informatique, la médecine et les nouvelles technologies, afin de démontrer qu’il est 
                            possible de réussir et d’exceller dans ces professions.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3>⚖️ Réduire les Barrières Structurelles et Culturelles</h3>
                        <p>
                            Offrir un accompagnement personnalisé pour surmonter les obstacles liés aux stéréotypes du genre.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3>📚 Renforcer les Compétences et la Confiance</h3>
                        <p>
                            Proposer des formations pratiques et des échanges enrichissants qui aident les jeunes femmes à se sentir légitimes et préparées.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3>🤝 Créer un Réseau de Soutien</h3>
                        <p>
                            Connecter les participantes avec des mentors, des pairs et des institutions engagées, 
                            pour les soutenir dans leurs parcours académiques et professionnels.
                        </p>
                    </div>
                </div>
            </div>

            <p class="mt-4 text-center">
                En valorisant une participation active des femmes, nous contribuons à renforcer leur confiance, leur compétence et leur impact dans des métiers clés.
            </p>
        </div>
    </section>

    @include('layouts.footer')
@endsection
