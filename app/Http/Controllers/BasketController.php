<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\ProductsRepository;
use App\Http\Repositories\BanRepository;

class BasketController extends Controller
{
    public function show(Request $request)
    {
        $basket = $request->session()->get("basket");
        return view('panier', [
            "basket" => $basket
        ]);
    }

    public function command(Request $request)
    {
        $commands = $request->session()->get("basket");
        foreach ($commands as $command)
        {
            {
                $res = ProductsRepository::command($request->session()->all()["user"]["id"], $command["product"]["id"], $command["quantity"]);
                if ($res)
                {
                    return view('oops');
                }
            }
        }
        $request->session()->forget("basket");
        $request->session()->put("basketValue", 0);
        return redirect('panier');
    }

    public function removeProduct(Request $request)
    {
        $request->session()->forget("basket");
        $request->session()->put("basketValue", 0);
        return redirect('panier');
    }

}
