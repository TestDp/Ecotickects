<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCamposPersonalizados extends Migration
{
    public function up()
    {
        Schema::create('tbl_campos_personalizados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Evento_id')->unsigned();
            $table->string('etiqueta');
            $table->string('opciones')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();
            $table->foreign('Evento_id')->references('id')->on('Tbl_Eventos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_campos_personalizados');
    }
}
