@extends('layouts.app')

@section('content')
<div class="container d-flex mt-5">
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

                <!-- Loader -->
                <div id="upload-loader" class="text-center mt-3 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Upload en cours, veuillez patienter...</span>
                    </div>
                    <p class="mt-2 text-muted">Upload en cours, veuillez patienter...</p>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image de Couverture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>

            <!-- ✅ Galerie du Podcast -->
            <h3 class="mt-5"><i class="fas fa-camera"></i> Galerie du Podcast</h3>
            <p class="text-muted">Ajoutez des images associées à ce podcast.</p>

            <div class="mb-3">
                <input type="file" id="gallery-upload" name="gallery[]" multiple>
            </div>

            <!-- Zone où les images uploadées s'afficheront dynamiquement -->
            <div id="gallery-preview" class="row my-5"></div>

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

@section('extra-js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.querySelector("form");
        let uploadLoader = document.getElementById("upload-loader");
        let submitButton = form.querySelector("button[type='submit']");

        form.addEventListener("submit", function(event) {
            let fileInput = document.getElementById("file");

            if (fileInput.files.length > 0) {
                uploadLoader.classList.remove("d-none"); // ✅ Afficher le loader si un fichier est sélectionné
                submitButton.disabled = true; // ✅ Désactiver le bouton pour éviter les doubles soumissions
            }
        });

        // ✅ Affichage des images sélectionnées pour la galerie
        let galleryInput = document.getElementById("gallery-upload");
        let galleryPreview = document.getElementById("gallery-preview");

        galleryInput.addEventListener("change", function(event) {
            galleryPreview.innerHTML = ""; // ✅ Effacer l'aperçu précédent
            let files = event.target.files;

            for (let i = 0; i < files.length; i++) {
                let fileReader = new FileReader();

                fileReader.onload = function(e) {
                    let imgElement = document.createElement("div");
                    imgElement.classList.add("col-md-3");
                    imgElement.innerHTML = `
                        <div class="gallery-item position-relative">
                            <img src="${e.target.result}" class="img-fluid rounded shadow-sm">
                        </div>
                    `;
                    galleryPreview.appendChild(imgElement);
                };

                fileReader.readAsDataURL(files[i]);
            }
        });
    });
</script>
@endsection