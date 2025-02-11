<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid gap-3">
    <a class="navbar-brand" href="{{ route('welcome') }}">
      <div class="header-logo">
        <img src="{{ asset('image/assologo.webp') }}" alt="logo">
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav gap-3">
        <a class="nav-item nav-link {{ Request::routeIs('programmes') ? 'active' : '' }}" href="{{ route('programmes') }}">Nos programmes</a>
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
            <li><a class="dropdown-item {{ Request::routeIs('sector.utilities') ? 'active' : '' }}" href="{{ route('sector.utilities') }}">Services publics</a></li>
          </ul>
        </div>

        <a class="nav-item nav-link {{ Request::routeIs('articles.index') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a>
        <a class="nav-item nav-link {{ Request::routeIs('podcasts.index') ? 'active' : '' }}" href="{{ route('podcasts.index') }}">Podcasts</a>
      </div>
    </div>

    @if(Auth::check())
      @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">📌 Tableau de Bord</a>
      @endif
      
    @endif
  </div>
</nav>