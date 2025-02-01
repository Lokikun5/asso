@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">📝 Créer un Nouvel Article</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Contenu</label>
            <textarea class="form-control editor" id="text" name="text" rows="8" required></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">✅ Publier</button>
        </div>
    </form>
</div>
@endsection