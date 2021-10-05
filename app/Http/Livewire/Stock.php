<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Categorie;

class Stock extends Component
{
    public $critere;
    public $query;
    public $category;

    public function render()
    {
        $category=Categorie::all();
        return view('livewire.stock',[
            'categories' => $category
        ]);
    }
}
