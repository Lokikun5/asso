@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container d-flex mt-5">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">➕ Ajouter un Partenaire</h2>

        <a href="{{ route('admin.partenaires.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Retour à la liste des Formateurs / bénévoles
        </a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.partenaires.store') }}" method="POST" enctype="multipart/form-data" id="partenaireForm">
            @csrf

            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description courte</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>

            <div class="mb-3">
                <label for="textEditor" class="form-label">Présentation complète</label>
                <textarea class="form-control editor" id="textEditor"></textarea>
                <input type="hidden" id="hiddenText" name="text" required>
            </div>

            <div class="mb-3">
                <label for="partner_link" class="form-label">Lien du partenaire</label>
                <input type="url" class="form-control" id="partner_link" name="partner_link">
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Image de profil</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">✅ Ajouter le Partenaire</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("✅ DOM chargé");

    if (window.tinymce) {
        console.log("✅ TinyMCE détecté");

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
        document.getElementById('partenaireForm').addEventListener('submit', function(event) {
            tinymce.triggerSave();
            let editorContent = tinymce.get("textEditor").getContent();
            document.getElementById('hiddenText').value = editorContent;

            console.log("✅ Contenu de TinyMCE enregistré :", editorContent);

            if (!editorContent.trim()) {
                alert("Veuillez remplir la présentation complète avant de soumettre.");
                event.preventDefault();
                return;
            }
        });
    } else {
        console.error("❌ TinyMCE non chargé");
    }
});
</script>
@endsection