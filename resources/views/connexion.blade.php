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
    @if(isset($connectionStatus))
        @switch($connectionStatus)
            @case("success")
                @include('components.connection.successConnection')
                @break
            @case("already_connected")
                @include('components.connection.alreadyConnected')
                @break
            @case("failure")
                @include('components.connection.failureConnection')
                @include('components.connection.connexionForm')
                @break

            @default
                @include('components.oops')
        @endswitch
    @else
        @include('components.connection.connexionForm')
    @endif
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
