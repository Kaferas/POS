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
            $table->integer("userId");
            $table->integer("productId");
            $table->integer("quantity");
            $table->text("description");
            $table->integer("total");
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
