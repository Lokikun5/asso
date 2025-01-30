@extends('layouts.app')

@section('content')

    @include('layouts.header')
    @include('introduction')
    @include('layouts.split_section')
    @include('article_section')
    @include('layouts.split_section')
    @include('from_section')
    @include('layouts.footer')

@endsection