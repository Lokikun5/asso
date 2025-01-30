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
        <a class="nav-item nav-link" href="{{ route('objectif') }}">Nos objectifs</a>
        <a class="nav-item nav-link" href="{{ route('activity') }}">Les activités prévues</a>
        <a class="nav-item nav-link" href="{{ route('target') }}">Public cible</a>
        <a class="nav-item nav-link" href="{{ route('articles.index') }}">Article</a>
      </div>
    </div>
  </div>
</nav>