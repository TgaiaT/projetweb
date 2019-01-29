{{-- The personal space page --}}
@extends('pages.basic')

@section('head')
    @parent
    @include('pages.base', ['title' => 'Espace personel BDE EXIA Nancy', 'description' => " Votre espace personnel: modifiez vos informations, droits a l'oubli."])
    @include('css.home')
@endsection

@section('header')
    @include('headers.header')
@endsection

@section('contents')
    @if(session()->get("isConnected"))
        @include('components.personnal.personnal')
        @if(session()->all()["user"]["rankLevel"] >= 4)
            @include('components.personnal.dl_images')
            @include('components.personnal.usersTable')
        @endif
    @else
        @include('components.connection.needConnection')
    @endif
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
