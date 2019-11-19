<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConfiguracionXSedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_ConfiguracionXSedes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Sede_id')->unsigned();
            $table->foreign('Sede_id')->references('id')->on('Tbl_Sedes');
            $table->decimal('precioMinimo',9,3);
            $table->decimal('precioMaximo',9,3);
            $table->date('VigenciaDesde');
            $table->date('VigenciaHasta');
            $table->decimal('Porcentaje',9,3)->nullable();
            $table->decimal('Impuesto1',9,3)->nullable();
            $table->decimal('Impuesto2',9,3)->nullable();
            $table->decimal('Comision1',9,3)->nullable();
            $table->decimal('Comision2',9,3)->nullable();
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
        Schema::dropIfExists('Tbl_ConfiguracionXSedes');
    }
}