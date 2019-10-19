<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPromotoresXSedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_PromotoresXSedes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Asistente_id')->unsigned();
            $table->foreign('Asistente_id')->references('id')->on('tbl_asistentes');
            $table->integer('Sede_id')->unsigned();
            $table->foreign('Sede_id')->references('id')->on('Tbl_Sedes');
            $table->boolean('esActivo')->default(1);
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
        Schema::dropIfExists('Tbl_PromotoresXSedes');
    }
}