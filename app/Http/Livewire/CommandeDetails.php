<?php

namespace App\Http\Livewire;

use App\Models\Commande_details;
use Livewire\Component;

class CommandeDetails extends Component
{
    public $has=false;
    public $hisId;
    public $currentCommand;
    public $retrieve_details;

    protected $listeners = [
        'catchCommande',
        'commande'
    ];

    public function commande($commande){
        $this->currentCommand= $commande;
    }

    public function looseView(){
        $this->has = ! $this->has;
    }

    public function catchCommande($id){
        $this->hisId=$id;
        $this->has=true;
        $this->retrieve_details=Commande_details::where('commande_id',$this->hisId)->get();
    }

    public function render()
    {
        return view('livewire.commande-details');
    }
}
