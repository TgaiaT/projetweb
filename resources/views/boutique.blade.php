@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base')
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    @include('components.boutiquePresentation')
    {{--@php
        if(isset($_GET['search']) || isset(isset($_GET['tri']) || isset(isset($_GET['plancher']) || isset(isset($_GET['plafond']) || isset(isset($_GET['catégorie']) ){
            //GENERER LA PAGE RECHERCHE
        } else {
            @include('components.boutiqueVitrine')
        }
    @endphp --}}
    @include('components.boutiqueVitrine')
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
