@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'pannier BDE Exia Nancy'])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Mon pannier</h2>
    @include("components.products.basket")
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
