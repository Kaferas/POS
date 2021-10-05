<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function show()
    {
        $activenow="stocks";
        return view("stocks.index",
            ["activenow"=> $activenow]
        );
    }
}
