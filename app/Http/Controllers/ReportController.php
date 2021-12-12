<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $activenow = "reports";
        return view("reports.index", [
            'activenow' => $activenow
        ]);
    }
}
