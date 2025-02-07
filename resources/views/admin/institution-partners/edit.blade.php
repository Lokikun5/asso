@extends('layouts.app')

@section('content')
<div class="container d-flex">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">✏️ Modifier l’Établissement Partenaire</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.institution-partners.update', $institutionPartner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $institutionPartner->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $institutionPartner->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="Écoles et universités" {{ $institutionPartner->category == 'Écoles et universités' ? 'selected' : '' }}>Écoles et universités</option>
                    <option value="Entreprises du secteur privé" {{ $institutionPartner->category == 'Entreprises du secteur privé' ? 'selected' : '' }}>Entreprises du secteur privé</option>
                    <option value="Services publics" {{ $institutionPartner->category == 'Services publics' ? 'selected' : '' }}>Services publics</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="active" class="form-label">Actif</label>
                <select name="active" id="active" class="form-control" required>
                    <option value="1" {{ $institutionPartner->active ? 'selected' : '' }}>Oui</option>
                    <option value="0" {{ !$institutionPartner->active ? 'selected' : '' }}>Non</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
            <a href="{{ route('admin.institution-partners.index') }}" class="btn btn-secondary">⏪ Retour</a>
        </form>
    </div>
</div>
@endsection