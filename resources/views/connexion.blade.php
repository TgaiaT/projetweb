{{-- The connection page --}}
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
            {{-- If success --}}
            @case("success")
                @include('components.connection.login.successConnection')
                @break
            {{-- If already connected --}}
            @case("already_connected")
                @include('components.connection.login.alreadyConnected')
                @break
            {{-- If fail --}}
            @case("failure")
                @include('components.connection.login.failureConnection')
                @include('components.connection.login.connexionForm')
                @break

            {{-- If something gone wrong --}}
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
