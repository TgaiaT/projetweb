<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SigninRequest;
use App\Repositories\Http\ConnectionRepository;

class ConnexionController extends Controller
{
    /*
     * Get the forms
     */
	public function getConnectionForm(Request $request)
	{
        if ($request->session()->get("isConnected"))
        {
            return response()->view('connexion', [
                "connectionStatus" => "already_connected"
            ])->header("refresh", "2;url=/");
        }
		return view('connexion');
	}

    public function getDisconnectionForm(Request $request)
    {
        if (!$request->session()->get("isConnected"))
        {
            return response()->view('deconnexion', [
                "connectionStatus" => "not_loged"
            ])->header("refresh", "2;url=/");
        }
        $request->session()->flush();
        return redirect("/");

    }

    public function getSigninForm(Request $request)
    {
        if ($request->session()->get("isConnected"))
        {
            return response()->view('connexion', [
                "connectionStatus" => "already_connected"
            ])->header("refresh", "2;url=/");
        }
        return view('inscription');
    }

    /*
     * Connection procedures
     */
	public function connect(LoginRequest $request)
	{
        $request->validated();
	    $password = $request->input("password");
	    $email = $request->input("email");

	    try
        {
            if ($result = ConnectionRepository::getConnection($email, $password))
            {
                $request->session()->put("isConnected", true);
                $request->session()->put("user", [
                    'id' => $result["users:id_user"],
                    'name' => $result["users:name"],
                    'lastname' => $result["users:lastname"],
                    'email' => $result["users:email"],
                    'token' => $result["users:token"],
                    'rank' => $result["users:id_rank"],
                    'campus' => $result["users:id_campus"],
                ]);
                return response()->view('connexion', [
                    "user" => $result,
                    "connectionStatus" => "success"
                ])->header("refresh", "2;url=/");
            }
            else
            {
                return view('connexion', [
                    "connectionStatus" => "failure"
                ]);
            }
        }catch (ConnectException | ClientException $e)
        {
            return view('connexion', [
                "connectionStatus" => "oops"
            ]);
        }
	}
    public function signin(SigninRequest $request)
    {
        $request->validated();
        $name = $request->input("name");
        $lastname = $request->input("lastname");
        $email = $request->input("email");
        $password = $request->input("password");

        try
        {
            if ($result = ConnectionRepository::registerUser($name, $lastname, $email, $password, "Nancy"))
            {
                $request->session()->put("isConnected", true);
                $request->session()->put("user", [
                    'id' => $result["id_user"],
                    'name' => $name,
                    'lastname' => $lastname,
                    'email' => $email,
                    'token' => $result["token"],
                    'rank' => $result["id_rank"],
                    'campus' => $result["id_campus"],
                ]);
                return response()->view('inscription', [
                    "connectionStatus" => "success"
                ])->header("refresh", "2;url=/");
            }
            else
            {
                return view('inscription', [
                    "connectionStatus" => "failure"
                ]);
            }
        }catch (ConnectException | ClientException $e)
        {
            return view('inscription', [
                "connectionStatus" => "oops"
            ]);
        }
    }


}
