<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->text("Code_barre")->nullable();
            $table->string("nom_produit");
            $table->text("description")->nullable();
            $table->integer("categorie_produit");
            $table->integer("prix_achat");
            $table->integer("prix_vente");
            $table->integer("interet");
            $table->date("date_in")->default(Carbon::now());
            $table->date("date_out")->nullable();
            $table->interger("jourGarantie")->nullable();
            $table->integer("unite_mesure")->nullable();
            $table->integer("quantite");
            $table->string("pic_path")->nullable();
            $table->string("product_code");
            $table->integer("alert_ecoulement")->default(20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
