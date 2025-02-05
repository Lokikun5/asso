@extends('layouts.app')

@section('content')

    @include('layouts.header') 
    <main>
    @include('introduction')
    @include('layouts.split_section')
    @include('article_section')
    @include('layouts.split_section')
    @include('from_section')
    </main>
    @include('layouts.footer')

@endsection