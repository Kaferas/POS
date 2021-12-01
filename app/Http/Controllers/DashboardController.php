<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // $firstDate  = new \DateTime("2019-01-01");
        // $secondDate = new \DateTime("2020-03-04");
        // $intvl = $firstDate->diff($secondDate);
        // dd($intvl);
        // dd(date('Y-m-d'));
        $ventes = DB::table('commande_details')
            ->select("commande_id")
            ->where("created_at", 'like', '%' . date('Y-m-d') . '%')
            ->distinct()
            ->get()
            ->count();

        $clients = Clients::all()->count();
        $produits = Produit::all()->count();
        $itemsExpiring = Produit::all();
        // dd($itemsExpiring);
        $activenow = "dashboard";
        return view("dashboard.index", [
            "activenow" => $activenow,
            'ventes' => $ventes,
            'clients' => $clients,
            'produits' => $produits,
            'soonExpire' => $itemsExpiring
        ]);
    }
}
