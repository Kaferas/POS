<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Fournisseur_Client extends Controller
{
    public function index()
    {
        $activenow="fournisseur_client";
        return view("fournisseur_client.index",[
            'activenow'=>$activenow
        ]);
    }
}
