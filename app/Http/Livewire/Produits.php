<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\{Categorie, Produit, Unite_Mesure};
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Picqer;

class Produits extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $edition = false;
    public $code;
    public $name;
    public $description;
    public $categorie;
    public $stock;
    public $categories = [];
    public $price;
    public $quantity;
    public $idPro;
    public $interet;
    public $action;
    public $picture;
    public $measure;
    public $search;
    public $buy_price;
    public $sell_price;
    public $date_in;
    public $date_out;

    protected $listeners = [
        'refreshen'
    ];
    public function refreshen()
    {
        sleep(1);
        $this->resetVar();
        $this->mount();
    }
    public function resetVar()
    {
        $this->code = null;
        $this->name = null;
        $this->description = null;
        $this->categorie = null;
        $this->stock = null;
        $this->price = null;
        $this->quantity = null;
    }
    public function mount()
    {
        $coPro = Produit::get("product_code")->toArray();

        do {
            $codeGen = rand(10000000, 99999999);
        } while (in_array($codeGen, $coPro));

        $this->code = "" . $codeGen;
        $this->categories = Categorie::orderBy("categorie_name")
            ->get();
    }

    public function updated()
    {
        $this->validate([
            "code" => "string",
            "name" => "required|string|max:20",
            "description" => "string",
            "picture" => "image|mimes:jpg,png,gif",
            "categorie" => "required",
            "measure" => "required",
            "buy_price" => "required|integer",
            "sell_price" => "required|integer",
            'stock' => "required|integer",
            "quantity" => "required|integer",
            "date_in" => "required|date",
            "date_out" => "required|date"
        ]);
    }

    public function save()
    {
        $this->validate([
            "code" => "string",
            "name" => "required|string|max:20",
            "description" => "string",
            "picture" => "image|mimes:jpg,png,gif",
            "categorie" => "required",
            "measure" => "required",
            "buy_price" => "required|integer",
            "sell_price" => "required|integer",
            'stock' => "required|integer",
            "quantity" => "required|integer",
            "date_in" => "required|date",
            "date_out" => "required|date"
        ]);
        // dd($this->picture->store("kaferas"));
        $redColor = "255,0,0";
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($this->code, $generator::TYPE_STANDARD_2_5, 2, 60);

        $path = $this->picture->store("Photos");
        $exploded = explode("/", $path);
        $path = end($exploded);
        $data = [
            'Code_barre' => $barcode,
            'nom_produit' => $this->name,
            'description' => $this->description,
            'categorie_produit' => $this->categorie,
            "prix_achat" => $this->buy_price,
            "prix_vente" => $this->sell_price,
            "interet" => $this->interet,
            "date_in" => $this->date_in,
            "date_out" => $this->date_out,
            "unite_mesure" => $this->measure,
            "pic_path" => $path,
            "product_code" => $this->code,
            'quantite' => $this->quantity,
            'alert_ecoulement' => $this->stock
        ];


        if ($this->idPro) {
            Produit::find($this->idPro)->update($data);
            session()->flash("message", "The Product updated ");
            $this->emit("refreshen");
        } else {
            Produit::create($data);
            session()->flash("message", "The Product has Been Saved");
            $this->emit("refreshen");
        }
    }
    public function toggleEdition()
    {
        $this->edition = false;
        $this->idPro = null;
        $this->resetVar();
        $this->mount();
    }

    public function selectItem($id, $action)
    {
        $this->idPro = $id;
        $this->action = $action;
        if ($this->action == "edit") {
            $this->edition = true;
            $editable = Produit::find($this->idPro);
            $this->code = $editable->product_code;
            $this->name = $editable->nom_produit;
            $this->description = $editable->description;
            $this->price = $editable->prix;
            $this->quantity = $editable->quantite;
            $this->stock = $editable->alert_ecoulement;
            $this->categorie = $editable->categorie_produit;
            $this->measure = $editable->unite_mesure;
            $this->buy_price = $editable->prix_achat;
            $this->sell_price = $editable->prix_vente;
            $this->interet = $editable->interet;
        }
        if ($this->action == "delete") {
            $this->dispatchBrowserEvent("OpendelProductModal");
        }
    }
    public function calculInteret()
    {
        $this->interet = $this->sell_price - $this->buy_price;
    }

    public function deleteProduct()
    {
        Produit::destroy($this->idPro);
        $this->idPro = null;
        $this->dispatchBrowserEvent("closedelProductModal");
    }

    public function render()
    {
        // dd(Unite_Mesure::orderBy("name"));

        return view('livewire.produit', [
            'products' => Produit::where(function ($query) {
                if ($this->search != "") {
                    $query->where("nom_produit", 'like', '%' . $this->search . '%');
                } else {
                    $query = Produit::all();
                }
            })->paginate(3),
            'categories' => Categorie::orderBy("categorie_name")->get(),
            'unites' => Unite_Mesure::orderBy("name")->get()
        ]);
    }
}
