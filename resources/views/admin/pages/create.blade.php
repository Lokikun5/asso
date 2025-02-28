@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container d-flex mt-5">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">➕ Ajouter une Page</h2>

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

        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug (URL)</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Contenu</label>
                <textarea class="form-control editor" id="content" name="content" rows="8"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">💾 Enregistrer</button>
            </div>
        </form>
    </div>
</div>

{{-- ✅ Chargement de TinyMCE --}}
@include('layouts.tinymce')
@endsection