<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastCommandeFacture extends Model
{
    use HasFactory;
    protected  $table="last_cmd_fac";
    protected $fillable = [
        "last_cmd",
        "last_facture"
    ];
}
