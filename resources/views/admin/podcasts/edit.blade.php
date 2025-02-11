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
                 <!-- Loader -->
                <div id="upload-loader" class="text-center mt-3 d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Upload en cours, veuillez patienter...</span>
                    </div>
                    <p class="mt-2 text-muted">Upload en cours, veuillez patienter...</p>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Remplacer l'Image de Couverture</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
            <h3 class="mt-5"><i class="fas fa-camera"></i> Galerie du Podcast</h3>
            <p class="text-muted">Ajoutez ou supprimez des images associées à ce podcast.</p>

            <div class="mb-3">
                <input type="file" id="gallery-upload" name="gallery[]" multiple>
            </div>

            <div class="row my-5">
                @foreach($podcast->media as $media)
                    <div class="col-md-3">
                        <div class="gallery-item position-relative">
                            <img src="{{ asset('storage/' . $media->file_name) }}" class="img-fluid rounded shadow-sm">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-media" data-id="{{ $media->id }}">🗑️</button>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1" {{ $podcast->active ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Activer ce Podcast</label>
            </div>

            <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
        </form>
    </div>
</div>
@section('extra-js')
<script>
      document.addEventListener("DOMContentLoaded", function() {
    let deleteButtons = document.querySelectorAll(".delete-media");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            let mediaId = this.getAttribute("data-id");
            let confirmation = confirm("Voulez-vous vraiment supprimer cette image ?");

            if (confirmation) {
                fetch(`/admin/podcasts/delete-media/${mediaId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest(".gallery-item").remove();
                    } else {
                        alert("Erreur lors de la suppression.");
                    }
                })
                .catch(error => {
                    console.error("Erreur:", error);
                    alert("Une erreur s'est produite.");
                });
            }
        });
    });
});

    document.addEventListener("DOMContentLoaded", function() {
        let form = document.querySelector("form");
        let uploadLoader = document.getElementById("upload-loader");
        let submitButton = form.querySelector("button[type='submit']");

        form.addEventListener("submit", function(event) {
            let fileInput = document.getElementById("file");

            if (fileInput.files.length > 0) {
                uploadLoader.classList.remove("d-none"); // Afficher le loader
                submitButton.disabled = true; // Désactiver le bouton pour éviter les doubles soumissions
            }
        });
    });

</script>
@endsection