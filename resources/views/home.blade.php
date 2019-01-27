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
    <h2 class="titre">BDE Cesi Nancy</h2>
    @include('components.presentations.presentation')
    @include('components.social')
    @include('components.presentations.eventPresentation')
    @include('components.presentations.memoriesPresentation')
    @include('components.presentations.ideasPresentation')
    @include('components.presentations.boutiquePresentation')
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
