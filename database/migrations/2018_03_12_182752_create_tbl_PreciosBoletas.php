<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPreciosBoletas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_PreciosBoletas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('localidad');
            $table->double('precio');
            $table->integer('cantidad');
            $table->integer('Evento_id')->unsigned();
            $table->foreign('Evento_id')->references('id')->on('Tbl_Eventos');
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
        Schema::dropIfExists('Tbl_PreciosBoletas');
    }
}
