<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsistentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_asistentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombres');
            $table->string('Apellidos');
            $table->string('Identificacion');
            $table->string('telefono');
            $table->string('Email');
            $table->integer('Edad');
            $table->string('Dirección');
            $table->integer('Ciudad_id')->unsigned();
            $table->foreign("Ciudad_id")->references('id')->on('Tbl_Ciudades');
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
        Schema::dropIfExists('tbl_asistentes');
    }
}
