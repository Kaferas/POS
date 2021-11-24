<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use App\Models\User;
use Livewire\Component;

class Depense extends Component
{
    public $type;
    public $fromdate;
    public $todate;
    public $users = [];
    public $products;

    public function mount()
    {
        $this->users = User::all();
        $this->products = Produit::all();
    }

    public function render()
    {
        return view('livewire.depense', [
            'users' => $this->users,
            'products' => $this->products
        ]);
    }
}
