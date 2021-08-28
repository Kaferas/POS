<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Categorie;
use Livewire\WithPagination;

class Categories extends Component
{
use WithPagination;
    public $name;
    protected $listeners=[
        "refreshen"
    ];

    public function refreshen()
    {
        sleep(3);
        $this->resetVar();
    }
    
    public function updated()
    {
        $this->validate([
            'name'=>"required|max:20"
        ]);
    }
    // public function mount()
    // {
    //     $this->name="Kaferas";
    // }

    public function resetVar()
    {
        $this->name="";
    }

    public function save()
    {
        $this->validate([
            'name'=>"required|max:20"
        ]);
        Categorie::create([
            "categorie_name"=> $this->name
        ]);
        session()->flash("message","Categorie well created");
        $this->resetVar();
        $this->emit("refreshen");
    }
    public function render()
    {
        $categories=Categorie::paginate(3);
        return view('livewire.categorie',[
            'categories'=>$categories
        ]);
    }
}
