<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande_details;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public $activenow = "reports";

    public function index()
    {
        return view("reports.index", [
            'activenow' => $this->activenow
        ]);
    }

    public function option()
    {
        return view("reports.reportOption",[
            'activenow'=> $this->activenow
        ]);
    }

    public function rapport(){
        extract($_GET);
        if($motif=='detaille'){
         $detailles=Commande_details::whereBetween('created_at',[$depart,$fin])->get();  
         return view("reports.index",[
            'activenow'=> $this->activenow,
            'detaille'=>$detailles
        ]);
        }else{
           $rawData= DB::table("commande_details")->select(array("produits.*",DB::raw('count(produit_id) as occurence')))
           ->whereBetween('produits.created_at',[$depart,$fin])
           ->join("produits",'commande_details.produit_id','=','produits.id')
           ->groupBy("produit_id")
           ->get();
           dd($rawData);
            return view("reports.index",[
                'activenow'=> $this->activenow,
            ]);
        }
    }
}
