@extends('pages.basic')

@section('head')
	@parent
    @include('pages.base', ['title' => 'Evénements BDE Exia Nancy', 'description' => " Evénements à venir : inscrivez vous au différentes activités disponibles. Evénements passés: Partagez des souvenirs en postant des photos et des commentaires."])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Evénements</h2>

    {{--
        Event creation button
    --}}
    @if(isset(session()->all()["user"]["rankLevel"]) && session()->all()["user"]["rankLevel"] >=5 )
        <div class="container my-4">
            <div class="row">
                <div class="col">
                    <a href="/event/create" class="btn btn-outline-primary mx-auto">Créer un événement</a>
                </div>
            </div>
        </div>
    @endif
    {{--
        Event creation message
    --}}
    @if(isset($creation_message))
        <div class="container-fluid">
            <div class="row">
                <div class="col mx-auto text-center border-light">
                    <h3>{{$creation_message}}</h3>
                </div>
            </div>
        </div>
    @endif

    {{--
        Future events
    --}}
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col mx-auto text-center">
                <h2>Liste des événements à venir :</h2>
            </div>
        </div>
    </div>
    @include('components.events.events', ["events" => $futureEvents, "timeline" => "future"])

    {{--
        Past events
    --}}
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col mx-auto text-center">
                <h2>Liste des événements passés :</h2>
            </div>
        </div>
    </div>
    @include('components.events.events', ["events" => $pastEvents, "timeline" => "past"])
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
