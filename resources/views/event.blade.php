@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	<h1 class="titre">Evenements</h1>
	@include('components.eventPresentation')
	@include('components.memoriesPresentation')
	@include('components.searchForm')
	@include('components.eventTemplate')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@parent
@endsection
