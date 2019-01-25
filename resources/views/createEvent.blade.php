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
        @if(isset($creation_message))
            <div class="container-fluid">
                <div class="row">
                    <div class="col mx-auto text-center border-light">
                        <h3>{{$creation_message}}</h3>
                    </div>
                </div>
            </div>
        @endif
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
