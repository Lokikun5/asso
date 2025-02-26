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

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
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
            <label for="textEditor" class="form-label">Contenu</label>
            <textarea class="form-control editor" id="textEditor"></textarea>
            <input type="hidden" id="hiddenText" name="text" required>
        </div>

        <div class="mb-3">
            <label for="img_banner" class="form-label">Image de couverture (optionnelle)</label>
            <input type="file" class="form-control" id="img_banner" name="img_banner">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">✅ Publier</button>
        </div>
    </form>
    <form action="{{ route('admin.articles.importLinkedin') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="linkedin_url" class="form-label">URL de l'article LinkedIn</label>
        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" required>
    </div>
    <button type="submit" class="btn btn-primary">Importer</button>
</form>

</div>

{{-- ✅ Script pour TinyMCE (Uniquement sur les pages nécessaires) --}}
@if(request()->routeIs(['admin.articles.create', 'admin.articles.edit']))
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