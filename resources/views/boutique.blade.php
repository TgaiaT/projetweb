{{-- The shop page --}}
@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Boutique BDE Exia Nancy', 'description' => " La boutique en ligne de notre campus. Nourriture, goodies, vetements à l'effigie du BDE et d'autres choses encore ! Venez commander en ligne ce dont vous avez besoins."])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Boutique</h2>
    {{--
        Product creation button
    --}}
    @if(isset(session()->all()["user"]["rankLevel"]) && session()->all()["user"]["rankLevel"] >=5 )
        <div class="container my-4">
            <div class="row mx-auto">
                <div class="col">
                    <a href="/product/create" class="btn btn-outline-primary mx-auto">Créer un produit</a>
                </div>
                <div class="col">
                    <a href="/categories/create" class="btn btn-outline-primary mx-auto">Ajouter une catégorie</a>
                </div>
            </div>
        </div>
    @endif

    @include('components.searchForm')
    {{--
        Most sold items
    --}}
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col mx-auto text-center">
                <h2>Produits les plus vendus :</h2>
            </div>
        </div>
    </div>
    @include('components.products.products', ["products" => $mostSold])

    {{--
        Items list
    --}}
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col mx-auto text-center">
                <h2>Liste des produits :</h2>
            </div>
        </div>
    </div>
    @include('components.products.products', ["products" => $products])
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
