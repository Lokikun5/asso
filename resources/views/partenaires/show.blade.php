@extends('layouts.app')
@section('title', $partner->first_name . ' ' . $partner->last_name)

@section('content')
@include('layouts.header')

@php
    $breadcrumbs = [
        ['name' => 'Nos Partenaires', 'url' => route('partenaires')],
        ['name' => $partner->first_name . ' ' . $partner->last_name, 'url' => route('partenaire.show', $partner->slug)]
    ];
@endphp

@include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

<div class="container py-5">
    <h1 class="text-center mb-4">{{ $partner->first_name }} {{ $partner->last_name }}</h1>
    <img src="{{ $partner->profile_picture }}" alt="{{ $partner->first_name }}" class="rounded-circle shadow-lg" width="150" height="150">
    <p class="text-center lead">{{ $partner->description }}</p>

    @if ($partner->partner_link)
        <p class="text-center">
            🔗 <a href="{{ $partner->partner_link }}" target="_blank" class="btn btn-success">
                Voir le site du partenaire
            </a>
        </p>
    @endif

    <div class="text-justify">
        <p>{{ $partner->text }}</p>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('partenaires') }}" class="btn btn-secondary btn-lg px-4">⏪ Retour aux partenaires</a>
    </div>
</div>

@include('layouts.footer')
@endsection