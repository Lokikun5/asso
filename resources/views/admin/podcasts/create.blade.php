@extends('layouts.app')

@section('content')
<div class="container d-flex">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <div>
            <!-- Bouton Retour -->
            <a href="{{ route('admin.podcasts.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Retour à la Liste des Podcasts
            </a>
        </div>
        <h2 class="my-4"><i class="fas fa-plus"></i> Ajouter un Nouveau Podcast</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.podcasts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom du Podcast</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
            </div>

            <div class="mb-3">
                <label for="page_content" class="form-label">Contenu de la Page</label>
                <textarea class="form-control editor" id="page_content" name="page_content" rows="8" required>{{ old('page_content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Fichier Audio (MP3, WAV, OGG)</label>
                <input type="file" class="form-control" id="file" name="file" accept=".mp3,.wav,.ogg" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image de Couverture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1">
                <label class="form-check-label" for="active">Activer ce Podcast</label>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
@endsection