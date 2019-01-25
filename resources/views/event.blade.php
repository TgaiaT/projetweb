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
    @if(isset(session()->all()["user"]["rankLevel"]) && session()->all()["user"]["rankLevel"] >=5 )
        <div class="container my-2">
            <div class="row">
                <div class="col">
                    <a href="/event/create" class="btn btn-outline-primary mx-auto">Créer un événement</a>
                </div>
            </div>
        </div>
    @endif
    @if(isset($creation_message))
        <div class="container-fluid">
            <div class="row">
                <div class="col mx-auto text-center border-light">
                    <h3>{{$creation_message}}</h3>
                </div>
            </div>
        </div>
    @endif
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
