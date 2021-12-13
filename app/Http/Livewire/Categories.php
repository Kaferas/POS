<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Categorie;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class Categories extends Component
{
    use WithPagination;
    public $name;
    public $updateName;
    public $action;
    public $selecteditem;
    public $edition = false;
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
        $this->resetVar();
    }

    public function updated()
    {
        $this->validate([
            'name' => "required|max:20"
        ]);
    }
    public function selectedItem($selectItem, $action)
    {
        $this->selecteditem = $selectItem;
        $this->action = $action;
        if ($action == "Edit") {
            $this->edition = true;
            $updateCategorie = Categorie::find($selectItem);
            $this->updateName = $updateCategorie->categorie_name;
        } else {
            $this->dispatchBrowserEvent("openModalDelete");
        }
    }

    public function delete($selectItem)
    {
        $this->dispatchBrowserEvent("closeCategorieModal");
        Categorie::destroy($selectItem);
    }

    public function resetVar()
    {
        $this->name = "";
    }

    public function updateCategorie()
    {
        Categorie::find($this->selecteditem)->update([
            "categorie_name" => $this->updateName
        ]);
        $this->edition = false;
        session()->flash("message", "Categorie Updated");
        $this->resetVar();
        $this->emit("refreshen");
    }

    public function save()
    {
        $this->validate([
            'name' => "required|max:20"
        ]);
        Categorie::create([
            "categorie_name" => $this->name
        ]);
        session()->flash("message", "Categorie well created");
        $this->resetVar();
        $this->emit("refreshen");
    }
    public function render()
    {
        $categories = Categorie::paginate(3);
        return view('livewire.categorie', [
            'categories' => $categories
        ]);
    }
}
