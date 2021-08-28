<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Produit,Commande_details,Commande,Transaction};
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Produit::orderBy("nom_produit")
                    ->get();
        $activenow="cashier";
        return view("order.index",[
            'activenow'=>$activenow,
            'products'=>$products
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
        // return $request->all();
        DB::transaction(function() use ($request){
                // Enregistrer Commande
            $commande= new Commande;
            $commande->name=$request->customer_name;
            $commande->adress=$request->customer_phone;
            $commande->save();
            $commande_id=$commande->id;

            // Enregistrer les Details de la Commande
            for ($prod_id=0; $prod_id < count($request->product_id); $prod_id++) { 
                $details_commande=new Commande_details;
                $details_commande->commande_id=$commande_id;
                $details_commande->produit_id=$request->product_id[$prod_id];
                $details_commande->quantite=$request->quantity[$prod_id];
                $details_commande->prix_unitaire=$request->price[$prod_id];
                $details_commande->total=$request->total_amount[$prod_id];
                $details_commande->promotion=$request->discount[$prod_id];
                $details_commande->save();
            }

            // Enregistrer la transaction
            // commande_Id 	montant-payer 	montant-restant 	mode-paiment 	utilisateur 	date_Transaction 	transaction-montant 
            $transactiom=new Transaction;
            $transactiom->commande_Id=$commande_id;
            $transactiom->utilisateur=1;
            $transactiom->montant_payer=$request->paid_amount;
            $transactiom->montant_restant=$request->remain_amount;
            $transactiom->mode_paiment=$request->payment;
            $transactiom->transaction_montant=$details_commande->total;
            $transactiom->date_Transaction=date("Y-m-d");
            $transactiom->save();

            // Last History
            $produits=Produit::all();
            $commande_details=Commande_details::where("commande_id",$commande_id)->get();
            $commandePar=Commande::where("id",$commande_id)->get();

            return view("order.index",[
                'products'=>$produits,
                'commandes_details'=>$commande_details,
                'commandePar'=>$commandePar
            ]);

            return back()->with("message","The Order has been successfully made");
            
        });
        return back()->with("error","The Order Fail to be ordered please chaeck your inputs");

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
