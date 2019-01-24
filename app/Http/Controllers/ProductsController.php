<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    public function showShop(Request $request)
    {
        $products = ProductsRepository::getProducts(
            $request->input("product_selector"),
            $request->input("product_categories"),
            $request->input("product_ordering"),
            $request->input("product_name")
        );
        return view('boutique', [
            "products" => $products,
        ]);
    }

    public function addToBasket(Request $request)
    {

    }
}
