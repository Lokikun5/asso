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
        <h2 class="my-4">➕ Ajouter un Établissement Partenaire</h2>

        <a href="{{ route('admin.institution-partners.index') }}" class="btn btn-secondary mb-5">
                <i class="fas fa-arrow-left"></i> Retour à la liste des Établissement Partenaire
        </a>

        <form action="{{ route('admin.institution-partners.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Écoles et universités">Écoles et universités</option>
                    <option value="Entreprises du secteur privé">Entreprises du secteur privé</option>
                    <option value="Services publics">Services publics</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="additional_info" class="form-label">Lien</label>
                <input type="text" name="additional_info" id="additional_info" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Actif</label>
                <select name="active" id="active" class="form-control" required>
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection