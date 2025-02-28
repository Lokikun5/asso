<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container-fluid gap-3">
    <div class="navbar-brand">
      <div class="header-logo">
        <img src="{{ asset('image/assologo-3.webp') }}" alt="logo">
      </div>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav gap-3">
        <a class="nav-item nav-link {{ Request::routeIs('welcome') ? 'active' : '' }}" href="{{ route('welcome') }}">Accueil</a>
        <a class="nav-item nav-link {{ Request::routeIs('programmes') ? 'active' : '' }}" href="{{ route('programmes') }}">Programmes</a>
        <a class="nav-item nav-link {{ Request::routeIs('activity') ? 'active' : '' }}" href="{{ route('activity') }}">Activités</a>
        <a class="nav-item nav-link {{ Request::routeIs('target') ? 'active' : '' }}" href="{{ route('target') }}">Public cible</a>

        <!-- Section Partenaire avec un dropdown -->
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::routeIs('partenaires') || Request::routeIs('etablissements.index') ? 'active' : '' }}" href="#" id="partnerDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Partenaires
          </a>
          <ul class="dropdown-menu" aria-labelledby="partnerDropdown">
            <li><a class="dropdown-item {{ Request::routeIs('partenaires') ? 'active' : '' }}" href="{{ route('partenaires') }}">Formateurs et bénévoles</a></li>
            <li><a class="dropdown-item {{ Request::routeIs('etablissements.index') ? 'active' : '' }}" href="{{ route('etablissements.index') }}">Écoles et universités</a></li>
            <li><a class="dropdown-item {{ Request::routeIs('private.companies') ? 'active' : '' }}" href="{{ route('private.companies') }}">Entreprises du secteur privé</a></li>
            <li><a class="dropdown-item {{ Request::routeIs('sector.utilities') ? 'active' : '' }}" href="{{ route('sector.utilities') }}">Secteur public</a></li>
          </ul>
        </div>

        <!-- Nouveau menu déroulant "Media" -->
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ Request::routeIs('articles.index') || Request::routeIs('podcasts.index') ? 'active' : '' }}" href="#" id="mediaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Médias
          </a>
          <ul class="dropdown-menu" aria-labelledby="mediaDropdown">
            <li><a class="dropdown-item {{ Request::routeIs('articles.index') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a></li>
            <li><a class="dropdown-item {{ Request::routeIs('podcasts.index') ? 'active' : '' }}" href="{{ route('podcasts.index') }}">Podcasts</a></li>
          </ul>
        </div>

        <!-- Lien Contact -->
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Contact
          </a>
          <ul class="dropdown-menu" aria-labelledby="contactDropdown">
            <li><a class="dropdown-item" href="tel:+228 92 40 55 08"><i class="fa-solid fa-phone"></i> Téléphone</a></li>
            <li><a class="dropdown-item" href="mailto:contact@africa-next-generation.org"><i class="fa-solid fa-envelope"></i> Mail</a></li>
          </ul>
        </div>
        <a class="linkedin-icon" href="https://www.linkedin.com/company/africa-next-generation" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
      </div>
      </div>
    </div>

    @if(Auth::check())
      @if(in_array(Auth::user()->role, ['admin', 'super-admin']))
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Tableau de Bord</a>
      @endif
    @endif
  </div>
</nav>