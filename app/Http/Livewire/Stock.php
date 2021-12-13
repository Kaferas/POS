<?php

namespace App\Http\Livewire;

use App\Models\Produit;
use Livewire\Component;
use App\Models\Categorie;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Stock extends Component
{
    use WithPagination;
    public $critere;
    public $query;
    public $category;
    public $headers;
    public $sortColumn = "created_at";
    public $sortDirection = "asc";


    public function __construct()
    {
        if (!Gate::allows('is_admin')) {
            abort(403);
        }
    }
    public function headerConfig()
    {
        return [
            'id' => "#",
            "nom_produit" => "Name",
            "product_code" => "Item Code",
            '' => "Action"
        ];
    }

    public function mount()
    {
        $this->headers = $this->headerConfig();
    }

    public function update()
    {
        $this->category = "";
        $this->query = "";
    }

    public function resultData()
    {
        return Produit::where(function ($query) {
            if ($this->query != "") {
                $query->where("nom_produit", 'like', '%' . $this->query . '%');
            } else if ($this->category != "") {
                $query->where("categorie_produit", $this->category);
            } else {
                $query = Produit::all();
            }
        })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(3);
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == "asc" ? 'desc' : 'asc';
    }

    public function danger($id)
    {
        $this->emit("catchId", $id);
    }

    public function render()
    {
        $category = Categorie::all();
        return view('livewire.stock', [
            'categories' => $category,
            'data' => $this->resultData()
        ]);
    }
}
