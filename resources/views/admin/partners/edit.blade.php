@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container d-flex">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">✏️ Modifier le Partenaire</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.partenaires.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $partner->first_name }}" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $partner->last_name }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description courte</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $partner->description }}" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">Présentation complète</label>
                <textarea class="form-control editor" id="text" name="text" rows="8" required>{{ $partner->text }}</textarea>
            </div>

            <div class="mb-3">
                <label for="partner_link" class="form-label">Lien du partenaire</label>
                <input type="url" class="form-control" id="partner_link" name="partner_link" value="{{ $partner->partner_link }}">
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Image de profil</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                @if($partner->profile_picture)
                    <p class="mt-2">Image actuelle :</p>
                    <img src="{{ $partner->profile_picture }}" alt="{{ $partner->first_name }}" width="100">
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@endsection