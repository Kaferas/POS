<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;

class DetailsStocks extends Component
{
    public $catched=null;
    public $display=false;
    public $data;

    protected $listeners=[
        'catchId'
    ];

    public function catchId($id)
    {
        $this->display=true;
        $this->catched= $id;
    }

    public function render()
    {
        return view('livewire.details-stocks',[
            'choosen'=> $this->catched
        ]);
    }
}
