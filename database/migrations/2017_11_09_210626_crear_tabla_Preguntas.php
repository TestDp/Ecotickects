<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPreguntas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Enunciado');
            $table->integer('TipoPregunta_id')->unsigned();
            $table->foreign('TipoPregunta_id')->references('id')->on('Tbl_Tipos_Preguntas');
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
        Schema::dropIfExists('Tbl_Preguntas');
    }
}
