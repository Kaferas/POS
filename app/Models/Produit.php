<?php

namespace App\Models;

use App\Http\Livewire\UniteMesure;
use App\Models\Categorie;
use App\Models\Unite_Mesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        "Code_barre", "nom_produit",    "description", "categorie_produit", "prix_achat",    "prix_vente",    "interet",    "date_in",    "date_out",    "unite_mesure",    "quantite",    "pic_path",    "product_code"
    ];

    public function categories()
    {
        return $this->hasMany(Categorie::class, "id");
    }

    public function unite_mesures()
    {
        return $this->hasMany(Unite_Mesure::class, "id");
    }
}
