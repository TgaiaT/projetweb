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
	@include('components.connexionForm')

    @php
        $req = curl_init();
        $header = [
            //'Content-type: application/json',
           'Authorization: passless@token',
        ];
        $params = [
            "values" => [
                "name" => "test",
                "lastname" => "test",
                "email" => "test",
                "password" => "test",
                "token" => "test",
                "id_rank" => 1,
                "id_campus" => 7,
            ]
        ];
        $options = [
            CURLOPT_URL => "api.vandeiheim.ovh:3000/users/7",
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header,
        ];

        curl_setopt_array($req, $options);

        $res = json_decode(curl_exec($req), true);
        print_r($res);
        curl_close($req);
    @endphp
@endsection

@section('footer')
	<div class="fixed-bottom">
		@include('footers.footer')
	</div>
@endsection

@section('scripts')
	@include('js.home')
	@parent
@endsection
