<?php

namespace App\Http\Livewire;

use toastr;
use App\Models\Produit;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Approvisionnement;
use RealRashid\SweetAlert\Facades\Alert;

class Approvision extends Component
{
    use WithPagination;
    public $produits;
    public $produit;
    public $produitValider;
    public $codeBarre;
    public $stockAlert;
    public $prixachat;
    public $prixvente;
    public $interet;
    public $quantite;
    public $history;
    public $hasHistory=false;
    protected $paginationTheme = "bootstrap";

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
       $this->hasHistory=false;
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
        $Retrieve_quantite = Produit::where("product_code", $this->codeBarre)->first()->quantite;
        $wasLast = Produit::where("product_code", $this->codeBarre)->first();
        $last = json_encode($wasLast);
        $data = [
            'codeProduit' => $this->codeBarre,
            'stock_alert' => $this->stockAlert,
            'quantite' => $this->quantite,
            'prixAchatUnit' => $this->prixachat,
            'prixVenteUnit' => $this->prixvente,
            'Interet' => $this->interet,
            'LastStock' => $last
        ];
        Approvisionnement::create($data);
        Produit::find(Produit::where("product_code", $this->codeBarre)->first()->id)->update([
            'alert_ecoulement' => $this->stockAlert,
            'quantite' => $this->quantite + $Retrieve_quantite,
            'prix_achat' => $this->prixachat,
            'prix_vente' => $this->prixvente,
            'interet' => $this->interet
        ]);
        $this->resetAll();
        return redirect(request()->header("Referer"))->with('message', 'Data added Successfully');;
    }

    public function floo($codeProduit)
    {
        $this->hasHistory=true;
        $producHistory=Approvisionnement::where('codeProduit',$codeProduit)->get('LastStock');
        $this->history=json_decode($producHistory);
        // dd($this->history);
        // return view("livewire.approvision",[
        //     'history'=> $this->history
        // ]);
    }

    public function render()
    {
        return view('livewire.approvision', [
            'latest' => Approvisionnement::distinct("codeProduit")->paginate(2)
        ]);
    }
}
