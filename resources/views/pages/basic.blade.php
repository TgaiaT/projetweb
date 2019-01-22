<!DOCTYPE html>
<html lang="fr">
<head>
	@section('head')
		<link <link rel="stylesheet" href="resources/assets/fontawesome/css/all.min.css">
	    <link <link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="resources/assets/css/style.css">
	@show
</head>
<body>
	@yield('header')
	
	@yield('contents')
	
	@yield('footer')
	
	@section('scripts')
		<script src="resources/assets/jquery/jquery-3.3.1.min.js"></script> 
	    <script src="resources/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	    <Script src="resources/assets/js/script.js"></Script>
	@show
</body>