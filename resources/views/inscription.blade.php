{{-- Registration page --}}
@extends('pages.basic')

@section('head')
	@parent
    @include('pages.base', ['title' => 'Inscription BDE Exia Nancy', 'description' => " Créez un compte pour bénéficier des fonctionnalités du site."])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
    @if(isset($connectionStatus))
        @switch($connectionStatus)
            @case("success")
            @include('components.connection.signin.successSignin')
            @break
            @case("already_connected")
            @include('components.connection.login.alreadyConnected')
            @break
            @case("failure")
            @include('components.connection.signin.failureSignin')
            @include('components.connection.signin.signinForm')
            @break

            @default
            @include('components.oops')
        @endswitch
    @else
        @include('components.connection.signin.signinForm')
    @endif
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
