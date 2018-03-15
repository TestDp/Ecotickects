<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarForenKeyEstadosMedioPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_InfoPagos', function (Blueprint $table) {
            $table->integer('EstadosTransaccion_id')->unsigned();
            $table->foreign('EstadosTransaccion_id')->references('id')->on('Tbl_EstadosTransaccion');
            $table->integer('MediosDePago_id')->unsigned();
            $table->foreign('MediosDePago_id')->references('id')->on('Tbl_MediosDePago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tbl_InfoPagos', function (Blueprint $table) {
            //
        });
    }
}
