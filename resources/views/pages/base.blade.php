<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	@section('head')
		<title>BDE EXIA NANCY</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link <link rel="stylesheet" href="http://localhost/projetweb/resources/assets/fontawesome/css/all.min.css">
	    <link <link rel="stylesheet" href="http://localhost/projetweb/resources/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/projetweb/resources/assets/css/style.css">
	@show
</head>
<body>
	@yield('header')
	
	<main>
		@yield('contents')
	</main>
	
	@yield('footer')
	
	@section('scripts')
		<script src="http://localhost/projetweb/resources/assets/jquery/jquery-3.3.1.min.js"></script> 
	    <script src="http://localhost/projetweb/resources/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	    <Script src="http://localhost/projetweb/resources/assets/js/script.js"></Script>
	@show
</body>