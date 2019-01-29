{{-- The structure of any page in the website --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    {{-- Head section, with css and base --}}
	@section('head')
		@stack('css')
	@show
</head>
<body>
    {{-- The header --}}
	@yield('header')

    {{-- Contents of the page --}}
	@yield('contents')

    {{-- The footer --}}
	@yield('footer')

    {{-- Scripts --}}
	@section('scripts')
		@stack('js')
	@show
</body>
