@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base')
	{{-- @include('css.home') --}}
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	@include('components.boutiquePresentation')
	@include('components.searchForm')
	@include('components.boutiqueVitrine')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	{{-- @include('js.home') --}}
	@parent
@endsection
