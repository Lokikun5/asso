@extends('layouts.app')

@section('content')
<div class="container d-flex">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <div>
            <!-- Bouton Retour au Site -->
            <a href="{{ url('/') }}" class="btn btn-secondary me-2">🏠 Retour au Site</a>

            <!-- Bouton Déconnexion -->
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">🚪 Déconnexion</button>
            </form>
        </div>
        <h2 class="my-4"><i class="fas fa-handshake"></i> Gestion des Partenaires</h2>
        <a href="{{ route('admin.partenaires.create') }}" class="btn btn-primary my-2">➕ Ajouter un Partenaire</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td>{{ $partner->id }}</td>
                        <td>{{ $partner->first_name }} {{ $partner->last_name }}</td>
                        <td>
                            <form action="{{ route('admin.partenaires.toggle', $partner->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm {{ $partner->active ? 'btn-success' : 'btn-warning' }}">
                                    {{ $partner->active ? '✅ Actif' : '⛔ Désactivé' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.partenaires.edit', $partner->id) }}" class="btn btn-info btn-sm">✏️ Modifier</a>
                            <form action="{{ route('admin.partenaires.destroy', $partner->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection