@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base', ['title' => 'Boite à idées BDE Exia Nancy'])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	@include('components.ideasPresentation')
	@include('components.ideeForm')
	@include('components.searchForm')
	@include('components.ideeTemplate')

@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection