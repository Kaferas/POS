<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;

class BenefitDetails extends Component
{
    public $display=null;
    public $catched=1;
    public $totalIn;

    protected $listeners=[
        'catchId'
    ];
    public function catchId($id)
    {
        $this->display=true;
        $this->catched= $id;
    }
    public function calculateTotal()
    {
        $produit=Produit::find($this->catched);
        $this->totalIn=$produit;
    }

    public function render()
    {
        $this->calculateTotal();
        return view('livewire.benefit-details',[
            'total'=> $this->totalIn
        ]);
    }
}
