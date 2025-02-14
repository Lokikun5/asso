@extends('layouts.app')

@section('title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    <div class="container my-5 min-vh-100">

        <h1 class="mb-4">{{ $page->title }}</h1>
       @if(empty($page->content))
            <div class="alert alert-warning text-center">
                🚧 Cette page est en construction. Revenez bientôt ! 🚧
            </div>
        @else
            <div>{!! (($page->content)) !!}</div>
        @endif
    </div>
@endsection
