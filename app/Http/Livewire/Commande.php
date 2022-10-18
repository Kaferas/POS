<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\WithPagination;

use Livewire\Component;
use PhpParser\Node\Expr\BinaryOp\Greater;

class Commande extends Component
{
    use WithPagination;
    public $sCommande;
    protected $paginationTheme ='bootstrap';

    public function getDetail($id,$code){
        $this->emit("catchCommande",$id);
        $this->emit("commande",$code);
    }


    
    public function render()
    {
        // $commandes= Transaction::orderBy("id",'desc')->paginate(6);
        return view('livewire.commande',[
            'commandes'=>Transaction::where(function ($query) {
                if ($this->sCommande != "") {
                    $query->where('code_commande', 'like', '%' . $this->sCommande . '%');
                } else {
                    $query = Transaction::paginate(6);
                }
            })->orderBy("id", "desc")->paginate(5),
        ]);
    }


}
