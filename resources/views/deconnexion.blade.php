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
            @case("not_loged")
            @include('components.connection.mustBeConnected')
            @break

            @default
            @include('components.oops')
        @endswitch
    @else
        @include('components.connection.mustBeConnected')
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
