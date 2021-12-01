<?php

namespace App\Models;

use App\Models\Unite_Mesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        "Code_barre", "nom_produit",    "description", "categorie_produit", "prix_achat",    "prix_vente",    "interet",    "date_in",    "date_out",    "unite_mesure",    "quantite",    "pic_path",    "product_code"
    ];

    public function categorie()
    {
        return $this->hasMany(Category::class, "unite_mesure");
    }
}
