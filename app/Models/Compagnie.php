<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    use HasFactory;

    protected $fillable=[
                            "nom_Compagnie", 	
                            "adress_Compagnie", 	
                            "phone_Compagnie", 	
                            "phone_email", 	
                            "phone_fax"
                        ];
}
