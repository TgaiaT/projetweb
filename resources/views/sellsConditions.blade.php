{{-- Mentions pages with the cgu and cookies regulations --}}
@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Conditions de Ventes BDE Exia Nancy', 'description' => " Conditions de Ventes du BDE Cesi Nancy."])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class=titre>Conditions de ventes</h2>
    @include('components.mentions.sells')
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
