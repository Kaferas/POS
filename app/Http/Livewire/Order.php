<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Produit;
class Order extends Component
{
    public $products=[];
    public $cart=[
        'produit_id'=>[],
        "quantity"=>[]
    ];
    public $activenow;
    public $quantity;

    protected $rules=[
        'produits'=>"required",
        'products'=>"required",
    ];




    public function mount()
    {
        $this->products=Produit::all();
        $this->activenow =="cashier";
    }

    public function updated()
    {
        $this->validate(["products"=>"required"]);
    }
    
    public function save()
    {
         dd($this->cart);
    }

    public function render()
    {
        return view('livewire.order');
    }
}
