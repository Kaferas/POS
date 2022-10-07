<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
