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
	<h1 class="titre">BDE Cesi Nancy</h1>
	@include('components.presentation')
	@include('components.social')
	@include('components.eventPresentation')
	@include('components.memoriesPresentation')
	@include('components.ideasPresentation')
	@include('components.boutiquePresentation')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection