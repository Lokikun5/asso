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
        <a class="nav-item nav-link {{ Request::routeIs('activity') ? 'active' : '' }}" href="{{ route('activity') }}">Les activités prévues</a>
        <a class="nav-item nav-link {{ Request::routeIs('target') ? 'active' : '' }}" href="{{ route('target') }}">Public cible</a>
        <a class="nav-item nav-link {{ Request::routeIs('partenaires') ? 'active' : '' }}" href="{{ route('partenaires') }}">Nos partenaires</a>
        <a class="nav-item nav-link {{ Request::routeIs('articles.index') ? 'active' : '' }}" href="{{ route('articles.index') }}">Articles</a>
      </div>
    </div>

    @if(Auth::check())
      @if(Auth::user()->role === 'admin')
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Tableau de Bord</a>
      @endif
      <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="btn btn-danger">Déconnexion</button>
      </form>
    @endif
  </div>
</nav>