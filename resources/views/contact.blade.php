{{-- The contact page --}}
@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Contact BDE Exia Nancy', 'description' => " Contact. Informations, adresse e-mail, numéro de téléphone, adresse postal. Contactez nous sur les réseaux sociaux."])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class='titre'>Contact</h2>
    @include('components.social')
    @include('components.contactPage')
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
