<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /*
     * Show the index.
     */
    public function index(Request $request)
    {
        $products = ProductsRepository::getMostSold();
        return view('home', [
            "products" => $products
        ]);
    }
}
