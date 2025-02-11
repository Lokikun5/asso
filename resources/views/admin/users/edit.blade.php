@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('layouts.dashboard-sidebar')
        </div>

        <!-- Contenu principal -->
        <div class="col-md-9">
            <h2 class="mb-4"><i class="fas fa-user-edit"></i> Modifier l'utilisateur</h2>

            <!-- Bouton Retour -->
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Retour à la liste des utilisateurs
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

            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ Nom -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'utilisateur</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Champ Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Champ Mot de passe (optionnel) -->
                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe (optionnel)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="text-muted">Laissez vide pour ne pas changer le mot de passe.</small>
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
            </form>
        </div>
    </div>
</div>
@endsection