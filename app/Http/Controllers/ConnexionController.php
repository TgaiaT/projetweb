<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SigninRequest;

class ConnexionController extends Controller
{
	public function getConnectionForm()
	{
		return view('connexion');
	}

    public function getDisconnectionForm()
    {
        return view('deconnexion');
    }

    public function getSigninForm()
    {
        return view('deconnexion');
    }


    /*public function connect(LoginRequest $request)
	{
		$request->validate([]);
		return view('connexion');
	}*/

	public function disconnect()
	{
        //TODO
		return view('deconnexion');
	}


	public function connect(LoginRequest $request)
	{
	    //TODO
        $request->validated();
        
	    $password = $request->input("password");
	    $email = $request->input("email");
		return view('home');
	}
    public function signin(SigninRequest $request)
    {
        //TODO
        $request->validated();
        return view('home');
    }


}
