{{-- Ideas box page --}}
@extends('pages.basic')

@section('head')
	@parent
    @include('pages.base', ['title' => 'Boite à idées BDE Exia Nancy', 'description' => " Proposez des activités et votez pour vos favorites afin qu'elles soient proposées dans les futures manifestations du BDE."])
	@include('css.home')
@endsection

@section('header')
	@include('headers.header')
@endsection

@section('contents')
    <h2 class="titre">Boite à idées</h2>

    @if(isset($creation_message))
        <div class="container-fluid">
            <div class="row">
                <div class="col mx-auto text-center border-light">
                    <h3>{{$creation_message}}</h3>
                </div>
            </div>
        </div>
    @endif
    {{-- Form --}}
    @if(session()->get("isConnected"))
        @include('components.activities.activityForm')
    @endif
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col mx-auto text-center">
                <h2>Liste des activités proposées :</h2>
            </div>
        </div>
    </div>
    {{-- Activities --}}
    @include('components.activities.activities', ["state" => "pending"])
    {{-- Banned activities --}}
    @if(session()->get("isConnected") && session()->all()["user"]["rankLevel"] >= 4)
        <div class="container-fluid my-4">
            <div class="row">
                <div class="col mx-auto text-center">
                    <h2>Liste des activités bannies :</h2>
                </div>
            </div>
        </div>
        @include('components.activities.activities', ["state" => "banned"])
    @endif
@endsection

@section('footer')
	@include('footers.footer')
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
