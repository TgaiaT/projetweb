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
    /*
     * Get all the products.
     */
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
            //Layout the products.
            return ProductsRepository::filterProducts($products, $selector, $categories, $ordering, $name);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    /*
     * Get the most sold products.
     */
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

    /*
     * Layout the raw products data to an products array.
     */
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

    /*
     * Count sells of products.
     */
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

    /*
     * Create a product.
     */
    public static function createProduct($name, $picture, $description, $price, $categories)
    {
        $client = ApiRepository::getClient();
        try
        {
            /*
             * Create the product
             */
            $url = "products";
            $res = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "product_name" => $name,
                        "product_picture" => $picture,
                        "product_description" => $description,
                        "product_price" => $price,
                        "id_state" => 5,
                    ]
                ]
            ]))->getBody()), true);
            if (isset($res["error"])) return true;

            /*
             * Get the created product ID
             */
            $res = json_decode((($client->request('GET', "products"))->getBody()), true)["result"];
            $idProduct = "";
            foreach ($res as $product)
            {
                if ($product["products:product_name"] == $name && $product["products:product_description"] == $description && $product["products:product_price"] == $price)
                {
                    $idProduct = $product["products:id_product"];
                }
            }
            if ($idProduct == "") return true;

            $url = "based";
            $res = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "id_campus" => 5,
                        "id_product" => $idProduct,
                    ]
                ]
            ]))->getBody()), true)["error"];
            if (isset($res["error"])) return true;

            if (isset($categories))
            {
                foreach ($categories as $category)
                {
                    $res = ProductsRepository::addCategory($category, $idProduct);
                    if ($res) return true;
                }
            }

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Create a category.
     */
    public static function createCategory($name)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "categories";
            $activities = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "category_name" => $name,
                    ]
                ]
            ]))->getBody()), true);
            if (!isset($activities["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Add a category to a product.
     */
    public static function addCategory($category, $id_product)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "fit";
            $activities = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "id_category" => $category,
                        "id_product" => $id_product,
                    ]
                ]
            ]))->getBody()), true);
            if (!isset($activities["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Ban or forgive a product.
     */
    public static function ban($id_product, $ban)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "products/" . $id_product;
            /*
             * Ban a product.
             */
            if ($ban)
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 2
                        ]
                    ]
                ]))->getBody()), true);
            }
            /*
             * Forgive a product.
             */
            else
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 3
                        ]
                    ]
                ]))->getBody()), true);
            }

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Purchase a product/command.
     */
    public static function command($id_user, $id_product, $quantity)
    {
        $client = ApiRepository::getClient();
        try
        {
            $time = time();
            $url = "commands";
            $res = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "id_user" => $id_user,
                        "command_time" => $time,
                    ]
                ]
            ]))->getBody()), true);
            if (isset($res["error"])) return true;

            /*
             * Get the command ID
             */
            $url = "commands";
            $res = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $id_command = 0;
            foreach ($res as $command)
            {
                if ($command["commands:command_time"] == $time)
                {
                    $id_command = $command["commands:id_command"];
                }
            }
            if (!isset($id_command)) return true;

            $url = "contain";
            $res = json_decode((($client->request('POST', $url, [
                "json" => [
                    "values" => [
                        "id_command" => $id_command,
                        "id_product" => $id_product,
                        "quantity" => $quantity,
                    ]
                ]
            ]))->getBody()), true);

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return true;
            }
        }catch (ConnectException | ClientException $e)
        {
            return  true;
        }
    }

    /*
     * Get all the categories.
     */
    public static function getCategories()
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "categories";
            $categories = json_decode((($client->request('GET', $url))->getBody()), true);

            if (!isset($categories["error"]))
            {
                $filteredActivity = [];
                foreach ($categories["result"] as $category)
                {
                    $filteredActivity[$category["categories:id_category"]]["name"] = $category["categories:category_name"];
                    $filteredActivity[$category["categories:id_category"]]["id"] = $category["categories:id_category"];
                }
                return $filteredActivity;
            }
            else
            {
                return null;
            }
        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

}
