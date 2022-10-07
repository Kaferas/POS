<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReportOption extends Component
{
    public $range="";
    public $yesterday;

    public function  __construct()
    {
        $this->yesterday= date("d-m-Y",strtotime(date("d-m-Y")."-1day"));
    }

    public function render()
    {
        return view('livewire.report-option');
    }

    public function grabRange()
    {

    }
}
