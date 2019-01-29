{{-- Show the form to create event --}}
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
    @if(session()->get("isConnected") && session()->all()["user"]["rankLevel"] >= 5)
        @include('components.events.eventsForm')
    @else
        @include('components.oops')
    @endif
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
