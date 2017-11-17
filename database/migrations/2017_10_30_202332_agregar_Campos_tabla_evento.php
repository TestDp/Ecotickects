<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCamposTablaEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_Eventos', function (Blueprint $table) {
            $table->dateTime("Fecha_Inicial_Registro");
            $table->dateTime('Fecha_Final_Registro');
            $table->integer('Ciudad_id')->unsigned();
            $table->foreign("Ciudad_id")->references('id')->on('Tbl_Ciudades');
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
