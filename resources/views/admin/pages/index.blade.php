@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container d-flex mt-5">
    @include('layouts.dashboard-sidebar')

    <div class="flex-grow-1 p-3">
        <h2 class="my-4">📄 Gestion des Pages Génériques</h2>

        <a href="{{ route('admin.pages.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Ajouter une nouvelle page
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($pages->isEmpty())
            <div class="alert alert-warning">Aucune page n'a été créée pour le moment.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary btn-sm">
                                    ✏️ Modifier
                                </a>
                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">
                                        🗑 Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection