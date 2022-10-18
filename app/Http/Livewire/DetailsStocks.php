<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;

class DetailsStocks extends Component
{
    public $catched = 1;
    public $display = false;
    public $data;
    public $totalIn = 0;

    protected $listeners = [
        'catchId'
    ];

    public function printCode(){
        $this->dispatchBrowserEvent('printCode');
    }

    public function catchId($id)
    {
        $this->display = true;
        $this->catched = $id;
    }

    public function calculateTotal()
    {
        $produit = Produit::find($this->catched);
        $this->totalIn = $produit;
    }

    public function render()
    {
        $this->calculateTotal();
        return view('livewire.details-stocks', [
            'choosen' => $this->catched,
            'total' => $this->totalIn
        ]);
    }
}
