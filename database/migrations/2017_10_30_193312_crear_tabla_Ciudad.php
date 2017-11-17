<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCiudad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Ciudades', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Codigo_Ciudad");
            $table->string('Nombre_Ciudad');
            $table->integer('Departamento_id')->unsigned();
            $table->foreign("Departamento_id")->references('id')->on('Tbl_Departamentos');
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
        Schema::dropIfExists('Tbl_Ciudades');
    }
}
