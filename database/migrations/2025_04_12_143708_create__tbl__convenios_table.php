<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Convenio', function (Blueprint $table) {
            $table->id();
            $table->string('Convenio');
            $table->unsignedBigInteger('Evento_id');
            $table->string('FormatoCodigo')->nullable();
            $table->string('URL')->nullable();
            $table->string('Web_service')->nullable();
            $table->timestamps();
            
            $table->foreign('Evento_id')->references('id')->on('Tbl_Eventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tbl_Convenios');
    }
}