<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable=[
    "nom_fournisseur" ,	
    "adress_fournisseur" ,	
    "phone_fournisseur" ,	
    "email_fournisseur"
    ];
}
