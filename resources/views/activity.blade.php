@extends('layouts.app')
@section('title', config('meta.activity.title'))
@section('description', config('meta.activity.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">📅 Les Activités Prévues</h1>

            <p class="text-center">
                Pour atteindre nos objectifs et permettre aux jeunes de découvrir, d’apprendre et de se projeter
                dans leur avenir professionnel, notre association propose un ensemble d'activités diversifiées et enrichissantes.
            </p>

            <p class="text-center">
                Ces initiatives, pensées pour inspirer et accompagner, offrent des opportunités concrètes de rencontres 
                et d’échanges avec des professionnels afin de découvrir les métiers d’avenir et de mieux préparer leur future carrière.
            </p>

            <!-- Accordéon pour organiser les différentes activités -->
            <div class="accordion" id="activitiesAccordion">

                <!-- Ateliers de découverte -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            🎨 Ateliers de Découverte
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#activitiesAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Organisation de sessions pratiques et semaines des métiers, animées par des professionnel(le)s.</li>
                                <li>Démonstrations techniques (équipements d’ingénierie, outils informatiques, etc.).</li>
                                <li>Partages d'expériences sur les parcours académiques et professionnels.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Mentorat et tutorat -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            👩‍🏫 Mentorat et Tutorat : « Un jeune, un mentor, un avenir éclairé »
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#activitiesAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Suivi individuel pour accompagner les jeunes dans leurs choix d’études et carrières.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Visites et stages immersifs -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            🏢 Visites et Stages Immersifs
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#activitiesAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Organisation de visites dans des entreprises, chantiers, hôpitaux ou laboratoires.</li>
                                <li>Facilitation de stages courts (1 à 2 semaines en entreprise) pour expérimenter les réalités professionnelles.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Conférences et tables rondes -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            🎤 Conférences et Tables Rondes
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#activitiesAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Événements sur les métiers d’avenir et les compétences recherchées.</li>
                                <li>Discussions autour des enjeux des secteurs concernés.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Création d'une plateforme numérique -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            💻 Création d’une Plateforme Numérique
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#activitiesAccordion">
                        <div class="accordion-body">
                            <ul>
                                <li>Ressources en ligne : articles, vidéos, fiches métiers.</li>
                                <li>Espaces collaboratifs pour connecter jeunes et mentors.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Section Finale avec un message motivant -->
            <p class="mt-5 text-center">
                🚀 Grâce à ces activités, nous donnons aux jeunes les outils et les opportunités nécessaires 
                pour bâtir un avenir professionnel prometteur et épanouissant !
            </p>
        </div>
    </section>

    @include('layouts.footer')
@endsection