<?php

namespace App\Http\Livewire;

use App\Models\Clients;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class Client extends Component
{
    public $nameCutomer;
    public $emailCustomer;
    public $phoneCustomer;
    public $adressCustomer;
    public $search;
    public $idItem;
    public $action;

    use WithPagination;
    protected $listeners = [
        "refreshen",
    ];


    public function __construct()
    {
        if (!Gate::allows('is_admin')) {
            abort(403);
        }
    }

    public function refreshen()
    {
        sleep(1);
        $this->resetField();
    }

    public function render()
    {
        // $clients = Clients::orderBy("created_at", "desc")->paginate(3);
        return view('livewire.client', [
            'clients' => Clients::where(function ($query) {
                if ($this->search != "") {
                    $query->where("Customer_name", 'like', '%' . $this->search . '%');
                } else {
                    $query = Clients::all();
                }
            })->orderBy("id", "desc")->paginate(3),
        ]);
    }

    public function selectedItem($id, $action)
    {
        $this->idItem = $id;
        $this->action = $action;
        if ($this->action == 'delete') {
            $this->dispatchBrowserEvent("OpenModaleditclient");
        }
        if ($this->action == 'edit') {
            $editable = Clients::find($this->idItem);
            $this->nameCutomer = $editable->Customer_name;
            $this->emailCustomer = $editable->email;
            $this->phoneCustomer = $editable->phone_number;
            $this->adressCustomer = $editable->Adress;
        }
    }
    public function deleteClient()
    {
        Clients::destroy($this->idItem);
        $this->idItem = null;
        $this->dispatchBrowserEvent("closedelClientModal");
    }

    public function resetField()
    {
        $this->nameCutomer = "";
        $this->emailCustomer = "";
        $this->phoneCustomer = "";
        $this->adressCustomer = "";
        $this->search = "";
        $this->idItem = "";
        $this->action = "";
    }
    public function save()
    {
        $this->validate([
            "nameCutomer" => "required|string",
            "emailCustomer" => "required|string",
            "phoneCustomer" => "required|integer",
            "adressCustomer" => "required|string",
        ]);
        $data = [
            "Customer_name" => $this->nameCutomer,
            "email" => $this->emailCustomer,
            "phone_number" => $this->phoneCustomer,
            "Adress" => $this->adressCustomer
        ];

        if ($this->idItem) {
            Clients::find($this->idItem)->update($data);
            session()->flash("message", "Customer well Updated");
        } else {

            Clients::create($data);
            session()->flash("message", "Customer well created");
        }
        $this->emit("refreshen");
    }
}
