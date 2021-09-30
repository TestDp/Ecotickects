<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuariosAsistenteEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Usuarios_X_AsistenteEvento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('AsistentesXEvento_id')->unsigned();
            $table->foreign('AsistentesXEvento_id')->references('id')->on('tbl_asistentesxevento');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
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
        Schema::dropIfExists('Tbl_Usuarios_X_AsistenteEvento');
    }
}
