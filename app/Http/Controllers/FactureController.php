<?php

namespace App\Http\Controllers;

use App\Models\Commande_details;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function receipt($codeFacture){
        $commande=Transaction::where("codeFacture",$codeFacture)->get();
        $commande_produit= Commande_details::where("nFacture", $codeFacture)->get();
        return view("receipt/index",
        [
            'commande'=>$commande,
            'commande_produit'=>$commande_produit
        ]);
    }
}
