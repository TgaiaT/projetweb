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
    <h2 class="text-center">
        Evénements à venir :
    </h2>
    @include('components.events.events', [
        "events" => $futureEvents
    ])
    <h2 class="text-center">
        Evénements passés :
    </h2>
    @include('components.events.events', [
        "events" => $pastEvents
    ])
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
