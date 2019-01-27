<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PicturesRepository;
use Illuminate\Http\Request;
use App\Http\Repositories\BanRepository;

class PicturesController extends Controller
{
    public function ban(Request $request)
    {
        if (isset($request->input("id_picture")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = PicturesRepository::ban($request->input("id_picture"), ($request->input("method") == "ban") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                BanRepository::ban($request->session()->all()["user"]["id"], "Your event have been banned !");
                return redirect('/event');
            }
        }
    }
}
