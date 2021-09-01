<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\{Categorie,Produit};
use Livewire\WithPagination;

class Produits extends Component
{
    use WithPagination;
    public $edition=false;
    public $code_barre;
    public $name;
    public $description;
    public $categorie;
    public $stock;
    public $categories=[];
    public $price;
    public $quantity;
    public $idPro;
    public $action;

    protected $listeners=[
        'refreshen'
    ];
    public function refreshen()
    {
        sleep(1);
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
       $data=[
            'Code_barre'=>$this->code_barre,
            'nom_produit'=>$this->name,
            'description'=>$this->description,
            'categorie_produit'=>$this->categorie,
            'prix'=>$this->price,
            'quantite'=>$this->quantity,
            'alert_ecoulement'=>$this->stock
        ];
        if($this->idPro)
        {
            Produit::find($this->idPro)->update($data);
            session()->flash("message","The Product updated ");
            $this->emit("refreshen");
        }
        else{
            Produit::create($data);
            session()->flash("message","The Product has Been Saved");
            $this->emit("refreshen");
        }
    }
    public function toggleEdition()
    {
        $this->edition= false;
        $this->idPro=null;
        $this->resetVar();
    }

    public function selectItem($id,$action)
    {
        $this->idPro=$id;
        $this->action=$action;
        if($this->action == "edit"){
            $this->edition=true;
            $editable=Produit::find($this->idPro);
            $this->code_barre= $editable->Code_barre;
            $this->name= $editable->nom_produit;
            $this->description= $editable->description;
            $this->price= $editable->prix;
            $this->quantity= $editable->quantite;
            $this->stock= $editable->alert_ecoulement;
        }
        if($this->action=="delete")
        {
           $this->dispatchBrowserEvent("OpendelProductModal");
        }
    }
     public function deleteProduct()
     {
         Produit::destroy($this->idPro);
         $this->dispatchBrowserEvent("closedelProductModal");

     }
    
    public function render()
    {
        return view('livewire.produit',[
            'products'=>Produit::paginate(5)
        ]);
    }
}
