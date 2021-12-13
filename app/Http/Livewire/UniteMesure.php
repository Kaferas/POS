<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Unite_Mesure;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;

class UniteMesure extends Component
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
            $updateCategorie = Unite_Mesure::find($selectItem);
            $this->updateName = $updateCategorie->name;
        } else {
            $this->dispatchBrowserEvent("mesureOpenModal");
        }
    }

    public function delete($selectItem)
    {
        $this->dispatchBrowserEvent("closeMesureModal");
        Unite_Mesure::destroy($selectItem);
    }

    public function resetVar()
    {
        $this->name = "";
    }

    public function updateCategorie()
    {
        Unite_Mesure::find($this->selecteditem)->update([
            "name" => $this->updateName
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
        Unite_Mesure::create([
            "name" => $this->name
        ]);
        session()->flash("message", "Categorie well created");
        $this->resetVar();
        $this->emit("refreshen");
    }
    public function render()
    {
        $unite = Unite_Mesure::paginate(3);
        return view('livewire.uniteMesure', [
            'unites' => $unite
        ]);
    }
}
