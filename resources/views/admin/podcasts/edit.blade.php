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
        <h2 class="my-4"><i class="fas fa-edit"></i> Modifier le Podcast</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.podcasts.update', $podcast->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nom du Podcast</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $podcast->name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $podcast->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Catégorie</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $podcast->category }}" required>
            </div>

            <div class="mb-3">
                <label for="page_content" class="form-label">Contenu de la Page</label>
                <textarea class="form-control editor" id="page_content" name="page_content" rows="8" required>{{ $podcast->page_content }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Remplacer le Fichier Audio (MP3, WAV, OGG)</label>
                <input type="file" class="form-control" id="file" name="file" accept=".mp3,.wav,.ogg">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Remplacer l'Image de Couverture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ $podcast->active ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Activer ce Podcast</label>
            </div>

            <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
        </form>
    </div>
</div>
@endsection