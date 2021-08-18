<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=
    [
    "commande_Id", 
    "montant-payer" ,	
    "montant-restant", 	
    "mode-paiment", 	
    "utilisateur", 	
    "date_Transaction" ,
    "transaction-montant" 
    ];
}
