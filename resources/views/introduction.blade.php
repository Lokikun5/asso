@php
    $heroImage = '/image/hero-bg.webp'; // Image spécifique par défaut

    if (isset($pageHeroImage) && file_exists(public_path($pageHeroImage))) {
        $heroImage = $pageHeroImage;
    }
@endphp
<section class="hero text-center py-5" style="background-image: url('{{ asset($heroImage) }}');">
    <div class="hero-content container">
        <h1 class="display-4">Association A.N.G.</h1>
        <p class="lead fst-italic">« Inspirer des vocations, élargir le champ des possibles… »</p>
    </div>
</section>

<section class="mission py-5 ">
    <div class="container">
        <h2 class="text-center mb-4">Notre mission</h2>
        <p>La mission de l'association A.N.G est de faciliter le transfert de connaissances et d'expériences professionnelles entre des experts actifs dans les domaines de l'ingénierie, 
            de l'informatique, de la santé et des nouvelles technologies,
             et les jeunes élèves, étudiant(e)s africain(e)s. 
        </p>
        <p class="text-center">
            <span>
                Afin de concrétiser cette vision, nous avons élaboré deux programmes :
            </span>
        </p>

        <div class="row">
            <div class="col-md-6">
                <div class="programme p-4 shadow-sm">
                    <h3>
                        <span> 1. Le Programme TGPD</span>
                        <span class="min-font-weigth"> « Transfert Générationnel, la Passerelle pour Demain » </span>
                    </h3>
                    <div class ="img-pages">
                        <img src="{{ asset('image/pages/programme-TGPD.webp') }}" alt="programme-TGPD">
                    </div>
                    <div class="text-responsive">
                        <p>
                            Ce programme s'adresse <span> aux jeunes élèves, étudiants et étudiantes africain(e)s,</span> 
                            avec pour ambition de les <span>accompagner dans leur orientation scolaire et professionnelle</span> 
                            tout en renforçant leurs compétences pratiques et théoriques pour mieux les préparer 
                            <span>à leur carrière professionnelle.</span>
                        </p>
                        <p>
                            Il vise également à leur permettre de mieux comprendre les opportunités et les défis des différents métiers, 
                            tout en facilitant leur accès à des réseaux professionnels et à des mentors.
                        </p>
                        <p>
                            En promouvant l'égalité des chances, ce programme offre à chacun des ressources et un réseau adapté pour construire un avenir prometteur.
                        </p>
                    </div>
                    <a href="{{ route('programmes') }}" class="btn btn-base-color mt-auto">En savoir plus</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="programme p-4 shadow-sm">
                    <h3>2. Le Programme FORV <br> <span class="min-font-weigth"> « Lycéennes, étudiantes, Osez et Rêvez Grand »</span></h3>
                    <div class ="img-pages">
                        <img src="{{ asset('image/pages/programme-FORV.webp') }}" alt="programme-FORV">
                    </div>
                    <div class="text-responsive">
                        <p>
                            Ce programme est né de l’idée de faire découvrir aux <span>jeunes filles des collèges, lycées et universités </span> l’éventail de
                            possibilités qui s’offrent à elles quant au choix de <span>leur carrière future.</span>
                        </p>
                        <p>
                            Dans le cadre de notre mission, nous accordons une attention particulière à 
                            <span>l’autonomisation des jeunes femmes africaines</span> et 
                            <span>à leur inclusion active dans des domaines essentiels</span> tels que l’ingénierie, l’informatique, la santé et les nouvelles technologies.
                        </p>
                        <p>
                        Nous croyons fermement que l'intégration et la réussite des
                        jeunes femmes dans ces secteurs stratégiques sont essentielles pour
                        une société plus équitable et innovante, et nous œuvrons à réduire cette disparité.
                        </p>
                    </div>
                    <a href="{{ route('programmes') }}#programme-feminin" class="btn btn-base-color mt-1">En savoir plus</a>
                </div>
            </div>
        </div>
    </div>
</section>
