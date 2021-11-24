<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index()
    {
        $activenow = "depenses";
        return view("depenses.index", [
            'activenow' => $activenow
        ]);
    }
}
