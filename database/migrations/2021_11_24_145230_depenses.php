<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Depenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("depenses", function (Blueprint $table) {
            $table->id();
            $table->text("description");
            $table->integer("total");
            $table->integer("quantity")->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('produit_id')->nullable();
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
        //
    }
}
