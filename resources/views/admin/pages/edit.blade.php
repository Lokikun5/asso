@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container d-flex mt-5">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">✏️ Modifier la Page</h2>

        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Retour à la liste des pages
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

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $page->title }}" required>
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $page->meta_description }}">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (URL validate)</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control editor" id="content" name="content" rows="8">{{ $page->content }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {

    let slugInput = document.getElementById("slug");

    slugInput.addEventListener("input", function () {
        let slugValue = slugInput.value;

        // Remplace les espaces et caractères spéciaux par des tirets
        slugValue = slugValue.toLowerCase()
            .replace(/[^a-z0-9-]+/g, "-")  // Remplace tout sauf a-z, 0-9 et "-"
            .replace(/^-+|-+$/g, "");  // Supprime les tirets au début et à la fin

        slugInput.value = slugValue;
    });

    // Vérification finale avant soumission du formulaire
    document.querySelector("form").addEventListener("submit", function (e) {
        let slugValue = slugInput.value;

        if (!/^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(slugValue)) {
            e.preventDefault(); // Empêche la soumission du formulaire
            alert("Le slug doit contenir uniquement des lettres minuscules, des chiffres et des tirets.");
        }
    });
});
</script>

@endsection
