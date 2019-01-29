{{-- Custom 404 error page --}}
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
    <div class="container-fluid">
        <div class="row text-center my-4">
            <div class="col mx-auto">
                <h3>La page demandée n'a pas été trouvée !</h3>
                @include('components.oops')
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('footers.footer')
@endsection

@section('scripts')
    @include('js.home')
    @parent
@endsection
