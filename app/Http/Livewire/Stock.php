<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorie;
use App\Models\Produit;
use Livewire\WithPagination;

class Stock extends Component
{
    use WithPagination;
    public $critere;
    public $query;
    public $category;
    public $headers;
    public $sortColumn="created_at";
    public $sortDirection="asc";

    public function headerConfig()
    {
        return [
            'id'=> "#",
            "nom_produit"=>"Name",
            "product_code"=>"Item Code",
            ''=>"Action"
        ];
    }

    public function mount()
    {
        $this->headers=$this->headerConfig();
    }

    public function resultData()
    {
        return Produit::orderBy($this->sortColumn,$this->sortDirection)
        ->paginate(5);
    }

    public function sort($column)
    {
        $this->sortColumn=$column;
        $this->sortDirection= $this->sortDirection == "asc" ? 'desc' : 'asc';
    }

    public function danger($id)
    {
        $this->emit("catchId",$id);
    }

    public function render()
    {
        $category=Categorie::all();
        return view('livewire.stock',[
            'categories' => $category,
            'data'=> $this->resultData()
        ]);
    }
}
