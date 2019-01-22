<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class ConnectionController extends Controller
{
	public function getForm()
	{
		return view('connexion');
	}
	
    public function connect(LoginRequest $request)
	{
		$request->validate([]);
		return view('connexion');
	}
	
	public function disconnect()
	{
		return view('deconnexion');
	}
}
