<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class ConnexionController extends Controller
{
	public function getForm()
	{
		return view('connexion');
	}
	
    /*public function connect(LoginRequest $request)
	{
		$request->validate([]);
		return view('connexion');
	}*/
	
	public function disconnect()
	{
		return view('deconnexion');
	}


	public function traitement()
	{

		request()->validate([
			'email' => ['required', 'email'],
			'password' => ['required'],

		]);

		/*auth()->attempt([
			'email' => request('email'),
			'password' => request('password'),

		]);*/


		return 'home.blade.php';
	}

}