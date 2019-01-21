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
	@include('components.connexionForm')
@endsection

@section('footer')
	<div class="fixed-bottom">
		@include('footers.footer')
	</div>
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection