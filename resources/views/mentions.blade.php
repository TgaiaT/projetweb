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
	<h1 class=titre>Mention légales</h1>
	@include('components.cgu')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
