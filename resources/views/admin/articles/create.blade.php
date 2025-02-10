@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container p-5">
    <h2 class="my-4">📝 Créer un Nouvel Article</h2>
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-backward"></i> Retour au tableau de bord
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="2" required></textarea>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type d'Article</label>
        <input class="form-control" id="type" name="type" required>
    </div>

    <div class="mb-3">
        <label for="text" class="form-label">Contenu</label>
        <textarea class="form-control editor" id="text" name="text" rows="8" required></textarea>
    </div>

    <div class="mb-3">
        <label for="img_banner" class="form-label">Image de couverture (optionnelle)</label>
        <input type="file" class="form-control" id="img_banner" name="img_banner">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success">✅ Publier</button>
    </div>
</form>

</div>
@endsection