<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTablaEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Nombre_Evento');
            $table->string("Lugar_Evento");
            $table->dateTime('Fecha_Evento');
            $table->enum('Tipo_Evento',['Evento','Cupón'])->default('Evento');
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
        Schema::dropIfExists('Tbl_Eventos');
    }
}
