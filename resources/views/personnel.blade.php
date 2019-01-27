@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Espace personel BDE EXIA Nancy'])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Mon espace perso</h2>

@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
