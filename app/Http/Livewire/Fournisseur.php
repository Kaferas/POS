<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Fournisseur extends Component
{
    public $company_name;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $avatar;

    public function save()
    {
        $this->validate([
            'company_name'=>"required|max:40",
            'firstname'=>"required|string",
            "lastname"=>"required|string",
            "email"=>"required|email",
            "phone"=>"required",
            "avatar"=>"required"
        ]);
        // Fournisseur::create([
        //     "categorie_name"=> $this->name
        // ]);
        session()->flash("message","Categorie well created");
        $this->resetVar();
        $this->emit("refreshen");
    }

    public function render()
    {
        return view('livewire.fournisseur');
    }

}
