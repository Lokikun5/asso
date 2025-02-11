@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- ✅ Sidebar à gauche -->
        <div class="col-md-3">
            @include('layouts.dashboard-sidebar')
        </div>

        <!-- ✅ Contenu principal à droite -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center bg-light p-3 mb-4 shadow-sm">
                <h3 class="m-0"><i class="fas fa-tools"></i> Tableau de Bord</h3>
                <div>{{ Auth::user()->name }} - {{ Auth::user()->role }}</div>


                <div>
                    <a class="btn btn-secondary me-2" href="{{ route('admin.profile') }}">Mon Profil</a>
                    <!-- Bouton Retour au Site -->
                    <a href="{{ url('/') }}" class="btn btn-secondary me-2">🏠 Retour au Site</a>

                    <!-- Bouton Déconnexion -->
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">🚪 Déconnexion</button>
                    </form>
                </div>
            </div>

            <h2 class="my-4"><i class="fas fa-thumbtack"></i> Tableau de Bord - Articles</h2>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary my-2">➕ Ajouter un Article</a>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Slug</th>
                        <th>Créé le</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->slug }}</td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $article->active ? 'btn-success' : 'btn-warning' }}">
                                        {{ $article->active ? '✅ Actif' : '⛔ Désactivé' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <!-- Bouton Modifier -->
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-info btn-sm">✏️ Modifier</a>

                                <!-- Bouton Supprimer avec Confirmation -->
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline; margin-left: 5px;" onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- ✅ Pagination -->
            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection