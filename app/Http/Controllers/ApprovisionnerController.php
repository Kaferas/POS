<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovisionnerController extends Controller
{
    public function index()
    {
        $activenow = "approvision";
        return view("provision.index", [
            'activenow' => $activenow
        ]);
    }
}
