<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\{Commande_details, Order, Transaction, Cart, Clients};

use function PHPUnit\Framework\isNull;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Produit::orderBy("nom_produit", "desc")->get();
        $activenow = "cashier";
        return view("order.index", [
            'activenow' => $activenow,
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->hide)) {
            // dd($request->hide);
            $commande = new Clients;
            $commande->Customer_name = $request->customer_name;
            $commande->email = $request->email;
            $commande->phone_number = $request->phone;
            $commande->Adress = $request->adress;
            $commande->save();
        }
        $commande_id = empty($request->hide) ? $commande->id : $request->hide;

        DB::transaction(function () use ($request, $commande_id) {
            // Enregistrer Commande

            $numeroFacture = Commande_details::get("nFacture")->toArray();

            do {
                $codeGen = rand(10000000, 99999999);
            } while (in_array($codeGen, $numeroFacture));


            $proUpdate = new Produit;
            // Enregistrer les Details de la Commande
            for ($prod_id = 0; $prod_id < count($request->product_id); $prod_id++) {
                $details_commande = new Commande_details;
                $details_commande->commande_id = $commande_id;

                $details_commande->produit_id = $request->product_id[$prod_id];
                $details_commande->quantite = $request->quantity[$prod_id];
                $found = $proUpdate::find($details_commande->produit_id);
                $quantiteRest = $found->quantite - $details_commande->quantite;
                $found->update(["quantite" => $quantiteRest]);
                $details_commande->prix_unitaire = $request->price[$prod_id];
                $details_commande->total = $request->total_amount[$prod_id];
                $details_commande->nFacture = $request->codeFac;
                $details_commande->userID = Auth::user()->id;
                $details_commande->promotion = $request->discount[$prod_id] ?? 0;
                $details_commande->save();
            }

            // Enregistrer la transaction
            // commande_Id 	montant-payer 	montant-restant 	mode-paiment 	utilisateur 	date_Transaction 	transaction-montant
            $transactiom = new Transaction;
            $transactiom->commande_Id = $commande_id;
            $transactiom->utilisateur = 1;
            $transactiom->montant_payer = $request->paid_amount;
            $transactiom->montant_restant = $request->remain_amount;
            $transactiom->mode_paiment = $request->payment;
            $transactiom->transaction_montant = $details_commande->total;
            $transactiom->date_Transaction = date("Y-m-d");
            $transactiom->save();

            // Cart::where("user_id", auth()->user()->id)->delete();
            // Last History
            $produits = Produit::all();
            $commande_details = Commande_details::where("commande_id", $commande_id)->get();
            $commandePar = Order::where("id", $commande_id)->get();
            return view("order.index", [
                'products' => $produits,
                'commandes_details' => $commande_details,
                'commandePar' => $commandePar
            ]);
        });
        return back()->with("error", "The Order Fail to be ordered please check your inputs");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
