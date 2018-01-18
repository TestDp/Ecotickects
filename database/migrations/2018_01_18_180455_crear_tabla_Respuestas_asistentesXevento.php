<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRespuestasAsistentesXevento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_respuestas_asistentesXeventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('AsistenteXEvento_id')->unsigned();
            $table->foreign('AsistenteXEvento_id')->references('id')->on('tbl_asistentesXeventos');
            $table->integer('Respuesta_id')->unsigned();
            $table->foreign('Respuesta_id')->references('id')->on('Tbl_Respuestas');
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
        Schema::dropIfExists('tbl_respuestas_asistentesXeventos');
    }
}
