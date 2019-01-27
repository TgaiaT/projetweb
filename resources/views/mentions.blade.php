@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Mentions légales BDE Exia Nancy'])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    <h2 class=titre>Mentions légales</h2>

@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
