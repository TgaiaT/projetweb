@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base')
	@include('home.css')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	@include('components.inscriptionForm')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
