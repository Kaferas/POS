<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=["product_id" ,	"product_qnty" , "product_code","product_price" ,	"user_id" ];

    public function product()
    {
        return $this->belongsTo("\App\Models\Produit","product_id");
    }

}
