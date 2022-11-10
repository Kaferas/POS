<?php

namespace App\Http\Controllers;


use App\Models\Produit;
use Illuminate\Http\Request;
use App\Events\AfterPayPrintEvent;
use Illuminate\Support\Facades\DB;
use \App\Models\LastCommandeFacture;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;
use App\Models\{Commande_details, Order, Transaction, Cart, Clients};

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
            $commande = new Clients;
            $commande->Customer_name = $request->customer_name;
            $commande->email = $request->email;
            $commande->phone_number = $request->phone;
            $commande->Adress = $request->adress;
            $commande->save();
        }
        $commande_id = empty($request->hide) ? 1 : $request->hide;

        DB::transaction(function () use ($request, $commande_id) {            
            $numeroFacture = Commande_details::get("nFacture")->toArray();
            $lastCmdFac=LastCommandeFacture::latest('last_cmd')->first();
            $newCmd= new LastCommandeFacture();
            $lastlast=null;
            if($lastCmdFac == null){
                $newCmd->last_cmd=1;
                $newCmd->last_facture=1;
                $newCmd->created_at=date('d-m-Y h:s:i');
                $newCmd->save();
            }
            else
            {
                $newCmd = LastCommandeFacture::find(1);
                $lastCmd=$newCmd->last_cmd;
                $lastFac=$newCmd->last_facture;
                $newCmd->last_cmd = intval($lastCmd)+1;
                $newCmd->last_facture = intval($lastFac)+1;
                $newCmd->update(
                    [
                        'last_cmd'=>$newCmd->last_cmd+1,'last_facture'=>$newCmd->last_facture+1
                    ]);           
                }
        
            do {
                $codeGen = rand(10000000, 99999999);
            } while (in_array($codeGen, $numeroFacture));


            $proUpdate = new Produit;
            
            $transactiom = new Transaction;
            $transactiom->code_commande = "C00".$newCmd->last_cmd+1;
            $transactiom->utilisateur = Auth::user()->id;
            $transactiom->clientId = $request->hide;
            $transactiom->montant_payer = $request->paid_amount;
            $transactiom->montant_restant = $request->remain_amount;
            $transactiom->mode_paiment = $request->payment;
            $transactiom->date_Transaction = date("Y-m-d");
            $transactiom->codeFacture = $request->codeFac;
            $transactiom->save();

            // Enregistrer les Details de la Commande
            for ($prod_id = 0; $prod_id < count($request->product_id); $prod_id++) {
               
                $details_commande = new Commande_details;
                $details_commande->commande_id = $transactiom->id;

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
            event(new AfterPayPrintEvent($transactiom));
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
