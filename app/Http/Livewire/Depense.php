<?php

namespace App\Http\Livewire;

use App\Models\Depenses;
use App\Models\Produit;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Depense extends Component
{
    use WithPagination;

    public $type;
    public $fromdate;
    public $todate;
    public $idDepense;
    public $action;
    public $users = [];
    public $products;
    public $produit;
    public $selectuser;
    public $username;
    public $spender;
    public $search;
    public $quantity;
    public $description;
    public $totalAmount;

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
        $this->produit = null;
        $this->selectuser = null;
        $this->username = null;
        $this->spender = null;
        $this->quantity = null;
        $this->description = null;
        $this->totalAmount = null;
    }

    public function mount()
    {
        $this->users = User::all();
        $this->products = Produit::all();
    }

    public function selectItem($id, $action)
    {
        $this->idDepense = $id;
        $this->action = $action;
        // dd($this->action);
        if ($this->action == "delete") {
            $this->dispatchBrowserEvent("openModalDepensedelete");
        }
        if ($this->action == "edit") {
            $editable = Depenses::find($this->idDepense);
            // dd($editable);
            $this->spender = $editable->spender;
            $this->description = $editable->description;
            $this->totalAmount = $editable->total;
            $this->username = Auth()->user()->id;
            if ($editable->produit_id) {
                $this->produit = $editable->produit_id;
                $this->type = "stock";
                $this->quantity = $editable->quantity;
            }
        }
    }

    public function deleteDepense()
    {
        Depenses::destroy($this->idDepense);
        $this->idDepense = null;
        $this->dispatchBrowserEvent("closeModalDepensedelete");
    }

    public function save()
    {
        $this->validate([
            "spender" => "required|string",
            "description" => "required|string",
            "totalAmount" => "required|integer"
        ]);
        $data = [
            "description" => $this->description,
            "total" => $this->totalAmount,
            "quantity" => $this->quantity,
            "user_id" => Auth()->user()->id,
            "produit_id" => $this->produit,
            "spender" => $this->spender
        ];
        if ($this->idDepense) {
            Depenses::find($this->idDepense)->update($data);
            session()->flash("message", "Outcome well Updated");
        } else {
            Depenses::create($data);
            session()->flash("message", "Outcome well Saved");
        }
        $this->emit("refreshen");
    }
    public function render()
    {
        return view('livewire.depense', [
            'users' => $this->users,
            'products' => $this->products,
            'depenses' => Depenses::where(function ($query) {
                if (!empty($this->search)) {
                    $query->where("spender", 'like', '%' . $this->search . '%')
                        ->where("user_id", Auth()->user()->id)
                        ->orWhere("description", 'like', '%' . $this->search . '%');
                }

                if (!empty($this->selectuser)) {
                    $query->where("user_id", $this->selectuser)
                        ->where("user_id", Auth()->user()->id)
                        ->whereBetween("created_at", [$this->fromdate, $this->todate]);
                } else {
                    $query = Depenses::all()
                        ->where("user_id", Auth()->user()->id);
                }
            })->paginate(4)
        ]);
    }
}
