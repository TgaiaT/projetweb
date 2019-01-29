<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UsersRepository;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\ProductRequest;
use GuzzleHttp\Promise\RejectionException;
use Illuminate\Http\Request;
use App\Http\Repositories\ProductsRepository;
use App\Http\Repositories\BanRepository;

class UsersController extends Controller
{
    public function show(Request $request)
    {
        if ($request->session("isConnected") && isset($request->session()->all()["user"]["rankLevel"]) && $request->session()->all()["user"]["rankLevel"] >= 4)
        {
            $ranks = UsersRepository::getRanks();
            return view('personnel', ["ranks" => $ranks]);
        }
        return view('personnel');
    }

    public function update(PersonnelRequest $request)
    {
        $request->validated();

        $new_password = $request->input("new_password");
        $old_password = $request->input("old_password");
        $email = $request->input("email");
        $campus = $request->input("campus");
        $id_user = $request->session()->all()["user"]["id"];
        $res = null;

        if (isset($old_password) && isset($email))
        {
            if ($request->session()->all()["user"]["email"] == $email && $request->session()->all()["user"]["password"] == hash("sha256", $old_password))
            {
                $res = UsersRepository::update($id_user, $new_password, $campus, null);
            }
        }
        else
        {
            $res = UsersRepository::update($id_user, $new_password, $campus, null);
        }

        if (isset($res) && $res)
        {
            return view('oops');
        }
        else
        {
            if (isset($old_password) && isset($email) && $request->session()->all()["user"]["email"] == $email && $request->session()->all()["user"]["password"] == hash("sha256", $old_password)) return redirect('/deconnexion');
            return redirect('/personnel');
        }

        return redirect('/personnel');
    }

    public function acceptCookie(Request $request)
    {
        setcookie("accept_cookies", true, time() + 365*24*3600);
        return redirect('');
    }

    public function closeAccount(Request $request)
    {
        if ($request->session()->get("isConnected"))
        {
            return redirect('/deconnexion');
        }
        else
        {
            return view('oops');
        }

    }

    public function getUsersJson()
    {
        $json = UsersRepository::formatToJson();
        return response()->json($json);
    }

    public function updateRank(Request $request)
    {
        $id_rank = $request->input("rank");
        $users = json_decode($request->input("rows"), true);
        $length = $request->input("rowsLength");

        for ($i = 0; $i < $length; $i++)
        {
            UsersRepository::update($users[$i]["id"], null, null, $id_rank);
        }

        return redirect('/personnel');
    }

}
