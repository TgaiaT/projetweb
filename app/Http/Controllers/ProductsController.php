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
    /*
     * Get the shop view.
     * get the most sold products and all the products and send it to the view.
     */
    public function showShop(Request $request)
    {
        $categories = null;
        if (isset($request->input("product_categories")[0])) $categories = explode(",", $request->input("product_categories"));

        $products = ProductsRepository::getProducts(
            $request->input("product_selector"),
            $categories,
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

    /*
     * Show the product form.
     */
    public function createFormProduct(Request $request)
    {
        return view('createProduct');
    }

    /*
     * Show the category form.
     */
    public function createFormCategory(Request $request)
    {
        return view('createCategory');
    }

    /*
     * Add a product to the basket.
     * Add the product to the session and to the cookie.
     */
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

        $item = [
            "product" => $product,
            "quantity" => $quantity,
        ];

        $request->session()->push("basket", $item);
        $request->session()->put("basketValue", $request->session()->get("basketValue") + $totalValue);

        setcookie("basket", json_encode($request->session()->get("basket")), time() + 365*24*3600, "/");
        setcookie("basketValue", json_encode($request->session()->get("basketValue")), time() + 365*24*3600, "/");

        return redirect('/boutique');
    }

    /*
     * Create a product.
     */
    public function createProduct(CreateProductRequest $request)
    {
        $request->validated();

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

    /*
     * Create a category.
     */
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

    /*
     * Add a category to a specified product.
     */
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

    /*
     * Ban a product.
     */
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
