<div class="bg-light p-3 shadow-sm" style="width: 250px; min-height: 100vh;">
    <h4>⚙️ Tableau de Bord</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active fw-bold' : '' }}" 
            href="{{ route('admin.dashboard') }}">
            📌 Tableau de Bord
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.partenaires.index') ? 'active fw-bold' : '' }}" 
                href="{{ route('admin.partenaires.index') }}">
                <i class="fas fa-handshake"></i> Gestion des formateur et bénévoles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.institution-partners.index') ? 'active fw-bold' : '' }}" 
                href="{{ route('admin.institution-partners.index') }}">
                <i class="fas fa-building"></i> Gestion des établissements partenaires
            </a>
        </li>
    </ul>
</div>
