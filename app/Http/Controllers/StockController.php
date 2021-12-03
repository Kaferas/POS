<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StockController extends Controller
{
    public function show()
    {
        if (Gate::allows("is_admin")) {

            $activenow = "stocks";
            return view(
                "stocks.index",
                ["activenow" => $activenow]
            );
        } else {
            abort(403);
        }
    }
}
