{{-- The shopping cart page --}}
@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Panier BDE Exia Nancy', 'description' => " Votre panier. Ajoutez des produits et commandez facilement sur internet."])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Mon panier</h2>
    @include("components.products.basket")
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
