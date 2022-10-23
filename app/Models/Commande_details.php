<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande_details extends Model
{
    use HasFactory;
    protected $fillable=
    [
        "commande_id",
        "produit_id",
        "quantite",
        "prix_unitaire",
        "total",
        "promotion",
        'nFacture',
        'userID'
    ];
    public function produit()
    {
        return $this->hasMany("\App\Models\Produit",'id','produit_id');
    }
    public function user()
    {
        return $this->hasMany("\App\Models\User",'id','userID');
    }
}
