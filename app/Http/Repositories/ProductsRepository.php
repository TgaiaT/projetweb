<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 23/01/2019
 * Time: 22:57
 */

namespace App\Http\Repositories;


use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class ProductsRepository
{
    public static function getProducts($selector, $categories, $ordering, $name)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "products?precision=max&getCategories=true";
            if (isset($selector) && $selector == "popularity")
            {
                $url = $url . "&getCommands=true";
            }
            $products = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return ProductsRepository::filterProducts($products, $selector, $categories, $ordering, $name);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    public static function getMostSold()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "products?precision=max&getCategories=true&getCommands=true";
            $products = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $products = ProductsRepository::filterProducts($products, "popularity", null, "des", null);
            $finalProducts = [];
            if (isset($products[0])) $finalProducts[0] = $products[0];
            if (isset($products[1])) $finalProducts[1] = $products[1];
            if (isset($products[2])) $finalProducts[2] = $products[2];
            return $finalProducts;
        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    private static function filterProducts($prods, $selector, $categories, $ordering, $name)
    {
        $finalProducts =  [];
        foreach ($prods as $prod)
        {
            $finalProducts[$prod["products:id_product"]]["id"] = $prod["products:id_product"];
            $finalProducts[$prod["products:id_product"]]["name"] = $prod["products:product_name"];
            $finalProducts[$prod["products:id_product"]]["picture"] = $prod["products:product_picture"];
            $finalProducts[$prod["products:id_product"]]["description"] = $prod["products:product_description"];
            $finalProducts[$prod["products:id_product"]]["price"] = $prod["products:product_price"];
            $finalProducts[$prod["products:id_product"]]["state"] = $prod["states:state"];
            if (!isset($finalProducts[$prod["products:id_product"]]["categories"]))
            {
                $finalProducts[$prod["products:id_product"]]["categories"] = [];
            }
            array_push($finalProducts[$prod["products:id_product"]]["categories"], $prod["categories:category_name"]);
            if (isset($selector) && $selector == "popularity")
            {
                $finalProducts[$prod["products:id_product"]]["commands"][$prod["commands:id_command"]]["user"] = $prod["commands:id_user"];
                $finalProducts[$prod["products:id_product"]]["commands"][$prod["commands:id_command"]]["quantity"] = $prod["contain:quantity"];
            }
        }

        /*
         * Scanning categories
         */
        $temp = [];
        if (isset($categories) && count($categories) > 0)
        {
            foreach ($finalProducts as $prod)
            {
                $haveCategory = false;
                foreach ($categories as $cat)
                {
                    if (in_array($cat, $prod["categories"]))
                    {
                        $haveCategory = true;
                    }
                }
                if ($haveCategory) array_push($temp, $prod);
            }
        }
        else
        {
            $temp = $finalProducts;
        }
        $finalProducts = $temp;

        /*
         * Scanning name
         */
        $temp = [];
        if (isset($name) && $name != "")
        {
            foreach ($finalProducts as $prod)
            {
                if (strpos(strtolower($prod["name"]), strtolower($name)) != false) array_push($temp, $prod);
            }
        }
        else
        {
            $temp = $finalProducts;
        }
        $finalProducts = $temp;

        /*
         * Scanning selector
         */
        $temp = [];
        if (isset($selector) && $selector != "")
        {
            switch ($selector)
            {
                /*
                 * Price selector
                 */
                case "price":
                    for ($i = 0; $i < count($finalProducts); $i++)
                    {
                        $currentProd = null;
                        foreach ($finalProducts as $prod)
                        {
                            if (!in_array($prod, $temp))
                            {
                                if (isset($currentProd))
                                {
                                    if (!isset($ordering) ||  (isset($ordering) && $ordering == "asc"))
                                    {
                                        if ($currentProd["price"] > $prod["price"])
                                        {
                                            $currentProd = $prod;
                                        }
                                    }
                                    elseif (isset($ordering) && $ordering == "des")
                                    {
                                        if ($currentProd["price"] < $prod["price"])
                                        {
                                            $currentProd = $prod;
                                        }
                                    }
                                }
                                else
                                {
                                    $currentProd = $prod;
                                }
                            }
                        }
                        $temp[$i] = $currentProd;
                    }
                    break;

                /*
                 * Popularity selector
                 */
                case "popularity":
                    $finalProducts = ProductsRepository::countSells($finalProducts);
                    for ($i = 0; $i < count($finalProducts); $i++)
                    {
                        $currentProd = null;
                        foreach ($finalProducts as $prod)
                        {
                            if (!in_array($prod, $temp))
                            {
                                if (isset($currentProd))
                                {
                                    if (!isset($ordering) ||  (isset($ordering) && $ordering == "asc"))
                                    {
                                        if ($currentProd["sells"] > $prod["sells"])
                                        {
                                            $currentProd = $prod;
                                        }
                                    }
                                    elseif (isset($ordering) && $ordering == "des")
                                    {
                                        if ($currentProd["sells"] < $prod["sells"])
                                        {
                                            $currentProd = $prod;
                                        }
                                    }
                                }
                                else
                                {
                                    $currentProd = $prod;
                                }
                            }
                        }
                        $temp[$i] = $currentProd;
                    }
                    break;

            }
        }
        else
        {
            $temp = $finalProducts;
        }
        $finalProducts = $temp;




        return $finalProducts;
    }

    private static function countSells($products)
    {
        $countedProducts =[];
        foreach ($products as $prod)
        {
            $sells = 0;
            foreach ($prod["commands"] as $q)
            {
                $sells = $sells + $q["quantity"];
            }
            $prod["sells"] = $sells;
            array_push($countedProducts, $prod);
        }
        return $countedProducts;
    }

}
