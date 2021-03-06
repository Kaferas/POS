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
}
