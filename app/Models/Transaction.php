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
    "montant_payer" ,	
    "montant_restant", 	
    "mode_paiment", 	
    "utilisateur", 	
    "date_Transaction" ,
    "transaction_montant" 
    ];
}
