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
    @if(isset($creation_message))
        <div class="container-fluid">
            <div class="row">
                <div class="col mx-auto text-center border-light">
                    <h3>{{$creation_message}}</h3>
                </div>
            </div>
        </div>
    @endif
    @if(session()->get("isConnected"))
        @include('components.activities.activityForm')
    @endif
    @include('components.activities.activities')
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
