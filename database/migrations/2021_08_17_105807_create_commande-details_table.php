<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande-details', function (Blueprint $table) {
            $table->id();
            $table->integer("commande_id");
            $table->integer("produit_id");
            $table->integer("quantite");
            $table->integer("prix-unitaire");
            $table->integer("total");
            $table->integer("promotion");
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
        Schema::dropIfExists('commande-details');
    }
}