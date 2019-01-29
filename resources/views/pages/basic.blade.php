<!DOCTYPE html>
<html lang="fr">
<head>
	@section('head')
		@stack('css')
	@show
</head>
<body>
	@yield('header')
	
	@yield('contents')
	
	@yield('footer')
	
	@section('scripts')
		@stack('js')
	@show
</body>
