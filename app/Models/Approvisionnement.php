<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;

    protected $fillable = ['codeProduit', 'quantite', 'stock_alert', 'prixAchatUnit', 'prixVenteUnit', 'Interet', 'LastStock'];


    public function nameProduit()
    {
        return $this->belongsTo(Produit::class, "codeProduit", "product_code");
    }
}
