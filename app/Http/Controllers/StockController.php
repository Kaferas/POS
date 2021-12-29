<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StockController extends Controller
{
    public function show()
    {
        $activenow = "stocks";
        // $qr = QrCode::size(200)->generate("IRakoze Chris Martin");
        return view(
            "stocks.index",
            [
                "activenow" => $activenow,
                // 'qr' => $qr
            ]
        );
    }
}
