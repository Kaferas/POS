<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable=[
        'Code_barre', 	'nom_produit', 	'description', 	'categorie_produit', 	'prix', 'quantite' 	
    ];
}
