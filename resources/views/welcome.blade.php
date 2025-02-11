@extends('layouts.app')

@section('content')
    <main>
    @include('introduction')
    @include('layouts.split_section')
    @include('article_section')
    @include('layouts.split_section')
    @include('podcast_section')
    @include('layouts.split_section')
    @include('from_section')
    </main>
@endsection