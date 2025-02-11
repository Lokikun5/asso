@extends('layouts.app')

@section('content')
<div class="container mt-5 min-vh-100">
    <h2>Mon Profil</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="password">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
            <input type="password" id="password" name="password" class="form-control">
        </div>
        
        <div class="mb-3">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection