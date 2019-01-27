<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\ProductsRepository;
use App\Http\Repositories\BanRepository;

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
        $mostSold = ProductsRepository::getMostSold();
        $categories = ProductsRepository::getCategories();
        return view('boutique', [
            "products" => $products,
            "mostSold" => $mostSold,
            "categories" => $categories,
        ]);
    }

    public function createFormProduct(Request $request)
    {
        return view('createProduct');
    }

    public function createFormCategory(Request $request)
    {
        return view('createCategory');
    }

    public function addToBasket(ProductRequest $request)
    {
        $request->validated();

        $quantity = $request->input("quantity");
        $product = json_decode($request->input("product"), true);
        $price = $product["price"];
        $totalValue = $quantity * $price;

        if (!isset($request->session()->get("basket")[0]))
        {
            $request->session()->put("basketValue", 0);
            $request->session()->put("basket", []);
        }

        $request->session()->push("basket", [
            "product" => $product,
            "quantity" => $quantity,
        ]);
        $request->session()->put("basketValue", $request->session()->get("basketValue") + $totalValue);

        return redirect('/boutique');
    }

    public function createProduct(CreateProductRequest $request)
    {
        $request->validated();

        //$category = $request->input("product_categories");
        $category = 9;
        if (
            isset($request->input("product_name")[0])
            && isset($request->input("product_description")[0])
            && isset($request->input("product_price")[0])
        )
        {
            $imageName = "userId=" . $request->session()->all()["user"]["id"] . "-productName=" . $request->input("product_name") . "-time=" . time() . "." . $request->file('picture_url')->getClientOriginalExtension();
            $url = base_path() . '/public/images/shop/';
            $request->file('picture_url')->move($url, $imageName);

            $res = ProductsRepository::createProduct($request->input("product_name"), "/images/shop/" . $imageName, $request->input("product_description"), $request->input("product_price"), [$category]);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                return redirect('/boutique');
            }
        }
    }

    public function createCategory(CreateCategoryRequest $request)
    {
        $request->validated();

        if (
            isset($request->input("category_name")[0])
        )
        {
            $res = ProductsRepository::createCategory($request->input("category_name"));
            if ($res)
            {
                return view('oops');
            }
            else
            {
                return redirect('/boutique');
            }
        }
    }

    public function addCategory(Request $request)
    {
        if (
        isset($request->input("id_category")[0])
        && isset($request->input("id_product")[0])
        )
        {
            $res = ProductsRepository::addCategory($request->input("id_category"), $request->input("id_product"));
            if ($res)
            {
                return view('oops');
            }
            else
            {
                return redirect('/boutique');
            }
        }
    }

    public function ban(Request $request)
    {
        if (isset($request->input("id_product")[0]) && isset($request->session()->all()["user"]["id"]) && isset($request->input("method")[0]))
        {
            $res = ProductsRepository::ban($request->input("id_product"), ($request->input("method") == "ban") ? true : false);
            if ($res)
            {
                return view('oops');
            }
            else
            {
                BanRepository::ban($request->session()->all()["user"]["id"], "Your product have been banned !");
                return redirect('/boutique');
            }
        }
    }
}
