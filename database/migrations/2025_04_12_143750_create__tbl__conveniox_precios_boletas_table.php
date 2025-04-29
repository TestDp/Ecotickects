<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblConvenioxPreciosBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_ConvenioxPreciosBoletas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PrecioBoleta_id');
            $table->unsignedBigInteger('Convenio_id');
            $table->string('Tarifa');
            $table->unsignedBigInteger('AsistentexEvento_id')->nullable();
            $table->timestamps();
            
            $table->foreign('PrecioBoleta_id')->references('id')->on('Tbl_PreciosBoletas');
            $table->foreign('Convenio_id')->references('id')->on('Tbl_Convenios');
            $table->foreign('AsistentexEvento_id')->references('id')->on('Tbl_asistentesXeventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tbl_ConvenioxPreciosBoletas');
    }
}