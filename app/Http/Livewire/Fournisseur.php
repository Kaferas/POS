<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Models\Fournisseur;
use App\Models\Fournisseurs;
use Livewire\WithFileUploads;

class Fournisseur extends Component
{
    use WithFileUploads;
    public $company_name;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $avatar;
    public $search;

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
        $this->company_name = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->email = null;
        $this->phone = null;
        $this->avatar = null;
        $this->search = null;
    }
    public function save()
    {
        $this->validate([
            'company_name' => "required|max:40",
            'firstname' => "required|string",
            "lastname" => "required|string",
            "email" => "required|email",
            "phone" => "required",
            "avatar" => "required"
        ]);
        Fournisseurs::create([
            "company_name" => $this->company_name,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "phone" => $this->phone,
            "phone" => $this->avatar,
        ]);
        session()->flash("message", "Supplier well created");
        // $this->resetVar();
        $this->emit("refreshen");
    }

    public function render()
    {
        return view('livewire.fournisseur', [
            'fournisseurs' => Fournisseurs::where(function ($query) {
                if ($this->search != "") {
                    $query->where('firstname', 'like', '%' . $this->search . '%')
                        ->Orwhere('lastname', 'like', '%' . $this->search . '%')
                        ->Orwhere('company_name', 'like', '%' . $this->search . '%');
                } else {
                    $query = Fournisseurs::all();
                }
            })->orderBy("id", "desc")->paginate(3),
        ]);
    }
}
