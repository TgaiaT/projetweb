@extends('pages.basic')

@section('head')
	@parent
    @include('pages.base', ['title' => 'Connection BDE Exia Nancy', 'description' => " Connectez vous pour accéder à toutes les fonctionnalités du site."])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
    @if(isset($connectionStatus))
        @switch($connectionStatus)
            @case("success")
                @include('components.connection.login.successConnection')
                @break
            @case("already_connected")
                @include('components.connection.login.alreadyConnected')
                @break
            @case("failure")
                @include('components.connection.login.failureConnection')
                @include('components.connection.login.connexionForm')
                @break

            @default
                @include('components.oops')
        @endswitch
    @else
        @include('components.connection.login.connexionForm')
    @endif
@endsection

@section('footer')
		@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
