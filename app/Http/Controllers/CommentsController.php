<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CommentsRepository;
use Illuminate\Http\Request;
use App\Http\Repositories\BanRepository;

class CommentsController extends Controller
{
    /*
     * Ban a comment.
     */
    public function ban(Request $request)
    {
        if (isset($request->input("id_comment")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = CommentsRepository::ban($request->input("id_comment"), ($request->input("method") == "ban") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                BanRepository::ban($request->session()->all()["user"]["id"], "Your comment have been banned !");
                return redirect('/event');
            }
        }
    }
}
