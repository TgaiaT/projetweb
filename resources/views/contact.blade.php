@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base', ['title' => 'Contact BDE Exia Nancy'])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	<h1 class='titre'>Contact</h1>
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
