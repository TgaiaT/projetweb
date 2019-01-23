@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base')
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
	{{-- boite a idée présentation --}}
	{{-- boutique présentation --}}
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@parent
@endsection