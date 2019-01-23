@extends('pages.basic')

@section('head')
	@parent
	@include('pages.base')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
	@include('components.presentation')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@parent
@endsection