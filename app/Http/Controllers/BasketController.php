<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MailRepository;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Repositories\ProductsRepository;
use App\Http\Repositories\BanRepository;

class BasketController extends Controller
{
    /*
     * Show the basket view.
     */
    public function show(Request $request)
    {
        $basket = $request->session()->get("basket");
        return view('panier', [
            "basket" => $basket
        ]);
    }

    /*
     * Proceed to the finalisation of a command. Purchase the command.
     * Send an email to the BDE email with the user and the command.
     * Send email to the user with the confirmation of the command and thanks.
     */
    public function command(Request $request)
    {
        $commands = $request->session()->get("basket");
        $commandList = "";
        $productName = " nom du produit : ";
        $productQuantity = " , quantité : ";

        foreach ($commands as $command)
        {
            {
                $res = ProductsRepository::command($request->session()->all()["user"]["id"], $command["product"]["id"], $command["quantity"]);
                if ($res)
                {
                    return view('oops');
                }
                $msg = $productName . $command["product"]["name"] . $productQuantity . $command["quantity"];
                $commandList = ($commandList == "") ? $msg : $commandList . " ; " . $msg;
            }
        }
        /*
         * Empty the basket :
         * -> remove the sessions data of the basket
         * -> remove the cookies data of the basket
         */
        $request->session()->forget("basket");
        $request->session()->put("basketValue", 0);
        setcookie("basketValue", 0, time() - 1, "/");
        setcookie("basket", null, time() - 1, "/");

        /*
         * Send the emails.
         */
        MailRepository::sendMail($request->session()->all()["user"]["email"], "Confirmation d'achat :", "Détail de la commande : " . $commandList);
        MailRepository::sendMail($request->session()->all()["user"]["email"], "Merci pour votre achat !", "Nous vous remercions pour la confiance que vous nous accordez, un membre du BDE vous contactera au plus vite pour vous remettre la commande.");
        MailRepository::sendMail("nathan.beer@viacesi.fr", $request->session()->all()["user"]["email"] . " a commandé !", "Contenu : " . $commandList);
        return redirect('panier');
    }

    /*
     * Empty the basket :
     * -> remove the sessions data of the basket
     * -> remove the cookies data of the basket
     */
    public function removeProduct(Request $request)
    {
        $request->session()->forget("basket");
        $request->session()->put("basketValue", 0);
        setcookie("basketValue", 0, time() - 1, "/");
        setcookie("basket", null, time() - 1, "/");

        return redirect('panier');
    }

}
