<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompagniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compagnies', function (Blueprint $table) {
            $table->id();
            $table->string("nom_Compagnie")->default("HALLELUIA FAST FOOD");
            $table->string("adress_Compagnie")->default("Carama ");
            $table->string("phone_Compagnie")->default("0025761193884");
            $table->string("phone_email")->default("halleluiaresto@gmail.com");
            $table->string("phone_fax")->default("00257222569");
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
        Schema::dropIfExists('compagnies');
    }
}
