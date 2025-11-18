@extends('layouts.app')
@section('title', 'Главная страница')
@section('content')
    @include('sections.banners')
    @include('sections.products')
@endsection
