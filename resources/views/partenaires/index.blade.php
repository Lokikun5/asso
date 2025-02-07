@extends('layouts.app')
@section('title', config('meta.partenaires.title'))
@section('description', config('meta.partenaires.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Nos membres formateur et bénévoles', 'url' => route('partenaires')]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">Nos membres formateur et bénévoles</h1>
            
            <div class="row mt-4">
            @foreach($partners as $partner)
            <div class="col-md-6 mb-4">
                <div class="p-4 border rounded shadow-sm d-flex align-items-center">
                    <img src="{{ asset($partner->profile_picture) }}" alt="{{ $partner->first_name }}" class="rounded-circle me-3" width="80" height="80">
                    <div>
                        <h3><i class="fas fa-handshake"></i> {{ $partner->first_name }} {{ $partner->last_name }}</h3>
                        <p>{{ Str::limit($partner->description, 100) }}</p>
                        <a href="{{ route('partenaire.show', $partner->slug) }}" class="btn btn-color btn-primary">
                            Voir le partenaire
                        </a>
                        <a href="{{ $partner->partner_link }}" class="btn btn-color2 btn-primary">
                            Linkedin
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>


            @if($partners->isEmpty())
                <p class="text-center mt-4 text-muted">Aucun partenaire pour le moment.</p>
            @endif


        </div>
    </section>

    @include('layouts.footer')
@endsection
