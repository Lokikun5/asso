@extends('layouts.app')

@section('content')
<div class="container d-flex mt-5">
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
        <h2 class="my-4"><i class="fas fa-microphone"></i> Gestion des Podcasts</h2>
        <a href="{{ route('admin.podcasts.create') }}" class="btn btn-primary my-2">
            <i class="fas fa-plus"></i> Ajouter un Podcast
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($podcasts->isEmpty())
            <p class="text-center text-muted">Aucun podcast n'est disponible pour le moment.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($podcasts as $podcast)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>{{ $podcast->name }}</td>
                            <td>{{ $podcast->category }}</td>
                            <td>
                                <form action="{{ route('admin.podcasts.toggle', $podcast->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $podcast->active ? 'btn-success' : 'btn-warning' }}">
                                        {{ $podcast->active ? '✅ Actif' : '⛔ Inactif' }}
                                    </button>
                                </form>
                            </td>
                            <td>{{ $podcast->created_at->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.podcasts.edit', $podcast->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form action="{{ route('admin.podcasts.destroy', $podcast->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce podcast ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $podcasts->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection