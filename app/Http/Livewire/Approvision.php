<?php

namespace App\Http\Livewire;

use App\Models\Approvisionnement;
use App\Models\Produit;
use Livewire\Component;

class Approvision extends Component
{
    public $produits;
    public $produit;
    public $produitValider;
    public $codeBarre;
    public $stockAlert;
    public $prixachat;
    public $prixvente;
    public $interet;
    public $quantite;

    public function mount()
    {
        $this->produits = Produit::all();
    }

    public function grabCodeBarre()
    {
        $grab = Produit::find($this->produit);
        $this->codeBarre = $grab->product_code;
        $this->stockAlert = $grab->alert_ecoulement;
        $this->prixachat = $grab->prix_achat;
        // $this->codeBarre;/
    }

    public function costInteret()
    {
        $this->interet = $this->prixvente - $this->prixachat;
    }
    public function resetAll()
    {
        $this->produits = null;
        $this->produit = null;
        $this->produitValider = null;
        $this->codeBarre = null;
        $this->stockAlert = null;
        $this->prixachat = null;
        $this->prixvente = null;
        $this->interet = null;
    }
    public function save()
    {
        $this->validate([
            'prixachat' => "required|integer",
            'prixvente' => "required|integer",
            'quantite' => "required|integer"
        ]);
        $last = json_encode(Produit::where("product_code", $this->codeBarre)->first());
        // dd($last);
        Approvisionnement::create([
            'codeProduit' => $this->codeBarre,
            'stock_alert' => $this->stockAlert,
            'quantite' => $this->quantite,
            'prixAchatUnit' => $this->prixachat,
            'prixVenteUnit' => $this->prixvente,
            'Interet' => $this->interet,
            'LastStock' => $last
        ]);
        $this->resetAll();
        return redirect(request()->header("Referer"));
    }
    public function render()
    {
        return view('livewire.approvision', [
            'latest' => Approvisionnement::latest()->paginate(4)
        ]);
    }
}
