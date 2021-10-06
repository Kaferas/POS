<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Commande_details,Order,Transaction,Cart};

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $products=Produit::orderBy("nom_produit")->get();
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
            $commande= new Order;
            $commande->name=$request->customer_name;
            $commande->adress=$request->customer_phone;
            $commande->save();
            $commande_id=$commande->id;

            $proUpdate=new Produit;
            // Enregistrer les Details de la Commande
            for ($prod_id=0; $prod_id < count($request->product_id); $prod_id++) {
                $details_commande=new Commande_details;
                $details_commande->commande_id=$commande_id;

                $details_commande->produit_id=$request->product_id[$prod_id];
                $details_commande->quantite=$request->quantity[$prod_id];
                $found=$proUpdate::find($details_commande->produit_id);
                $quantiteRest=$found->quantite-$details_commande->quantite;
                $found->update(["quantite"=>$quantiteRest]);
                $details_commande->prix_unitaire=$request->price[$prod_id];
                $details_commande->total=$request->total_amount[$prod_id];
                $details_commande->promotion=$request->discount[$prod_id] ?? 0;
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


            Cart::where("user_id",auth()->user()->id)->delete();

            // Last History
            $produits=Produit::all();
            $commande_details=Commande_details::where("commande_id",$commande_id)->get();
            $commandePar=Order::where("id",$commande_id)->get();

            return view("order.index",[
                'products'=>$produits,
                'commandes_details'=>$commande_details,
                'commandePar'=>$commandePar,
                "message"=>"The Order has been successfully made"
            ]);

            // return back()->with("message","");

        });
        return back()->with("error","The Order Fail to be ordered please check your inputs");

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
