<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\{Categorie,Produit};
use Livewire\WithPagination;

class Produits extends Component
{
    use WithPagination;
    public $code_barre;
    public $name;
    public $description;
    public $categorie;
    public $stock;
    public $categories=[];
    public $price;
    public $quantity;

    protected $listeners=[
        'refreshen'
    ];
    public function refreshen()
    {
        sleep(3);
        $this->resetVar();
    }
    public function resetVar()
    {
        $this->code_barre=null;
        $this->name=null;
        $this->description=null;
        $this->categorie=null;
        $this->stock=null;
        $this->price=null;
        $this->quantity=null;
    }
    public function mount()
    {
        $this->categories=Categorie::orderBy("categorie_name")
                ->get();
    }

    public function updated()
    {
        $this->validate([
            "code_barre"=>"integer",
            "name"=>"required|string|max:20",
            "description"=>"string",
            "categorie"=>"required",
            "price"=>"required|integer",
            'stock'=>"required|integer",
            "quantity"=>"required|integer"
        ]);
    }

    public function save()
    {
        $this->validate([
            "code_barre"=>"integer",
            "name"=>"required|string|max:20",
            "description"=>"string",
            "categorie"=>"required",
            "price"=>"required|integer",
            'stock'=>"required|integer",
            "quantity"=>"required|integer"
        ]);
        Produit::create([
            'Code_barre'=>$this->code_barre,
            'nom_produit'=>$this->name,
            'description'=>$this->description,
            'categorie_produit'=>$this->categorie,
            'prix'=>$this->price,
            'quantite'=>$this->quantity,
            'alert_ecoulement'=>$this->stock
        ]);
        session()->flash("message","The Product has Been Saved");
        $this->emit("refreshen");
    }

    public function render()
    {
        return view('livewire.produit',[
            'products'=>Produit::paginate(3)
        ]);
    }
}
