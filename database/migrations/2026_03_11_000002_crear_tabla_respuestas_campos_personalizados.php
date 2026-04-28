<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRespuestasCamposPersonalizados extends Migration
{
    public function up()
    {
        Schema::dropIfExists('tbl_respuestas_campos_personalizados');
        Schema::create('tbl_respuestas_campos_personalizados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('CampoPersonalizado_id')->unsigned();
            $table->integer('AsistenteXEvento_id')->unsigned();
            $table->string('valor');
            $table->timestamps();
            $table->foreign('CampoPersonalizado_id', 'fk_rcp_campo')->references('id')->on('tbl_campos_personalizados');
            $table->foreign('AsistenteXEvento_id', 'fk_rcp_asistente_evento')->references('id')->on('tbl_asistentesXeventos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_respuestas_campos_personalizados');
    }
}
