@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container p-5">
    <h2 class="my-4">✏️ Modifier l'Article</h2>
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

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $article->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Type d'Article</label>
            <input class="form-control" id="type" name="type" value="{{ $article->type }}" required>
        </div>

        <div class="mb-3">
            <label for="textEditor" class="form-label">Contenu</label>
            <textarea class="form-control editor" id="textEditor">{{ $article->text }}</textarea>
            <input type="hidden" id="hiddenText" name="text" required>
        </div>

        <div class="mb-3">
            <label for="img_banner" class="form-label">Image de l'Article</label>
            <input type="file" class="form-control" id="img_banner" name="img_banner">
        </div>

        <!-- <i class="fas fa-camera"></i> Gestion de la Galerie -->
        <h3 class="mt-4"><i class="fas fa-camera"></i> Galerie de l'Article</h3>
        <div class="mb-3">
            <input type="file" id="gallery-upload" name="gallery[]" multiple>
        </div>

        <div class="row">
            @foreach($article->media as $media)
                <div class="col-md-3">
                    <div class="gallery-item position-relative">
                        <img src="{{ asset('storage/' . $media->file_name) }}" class="img-fluid rounded shadow-sm">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-media" data-id="{{ $media->id }}">🗑️</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">💾 Mettre à Jour</button>
        </div>

    </form>
</div>

{{-- ✅ Script pour TinyMCE (Uniquement sur les pages nécessaires) --}}
@if(request()->routeIs(['admin.articles.edit']))
<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("✅ DOM chargé, vérification de TinyMCE...");

    if (typeof tinymce !== "undefined") {
        console.log("✅ TinyMCE détecté, initialisation...");
        
        tinymce.init({
            selector: 'textarea.editor',
            menubar: true,
            plugins: 'lists link image',
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
            setup: function(editor) {
                editor.on('init', function() {
                    console.log("✅ TinyMCE prêt");
                    tinymce.triggerSave();
                    document.getElementById('hiddenText').value = editor.getContent();
                });

                editor.on('change', function() {
                    tinymce.triggerSave();
                    document.getElementById('hiddenText').value = editor.getContent();
                });

                editor.on('blur', function() {
                    tinymce.triggerSave();
                    document.getElementById('hiddenText').value = editor.getContent();
                });
            }
        });

        // ✅ Avant soumission, s'assurer que la valeur de TinyMCE est bien enregistrée
        document.getElementById('articleForm').addEventListener('submit', function(event) {
            tinymce.triggerSave();
            let editorContent = tinymce.get("textEditor").getContent();
            document.getElementById('hiddenText').value = editorContent;

            console.log("✅ Contenu de TinyMCE enregistré :", editorContent);

            if (!editorContent.trim()) {
                alert("Veuillez remplir le contenu avant de soumettre.");
                event.preventDefault();
                return;
            }
        });
    } else {
        console.error("❌ TinyMCE non chargé");
    }
});
</script>
@endif

@endsection