<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoMaxLocalidadCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_Eventos', function (Blueprint $table) {
            $table->integer('maxLocalidadCompra')->default(10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tbl_Eventos', function (Blueprint $table) {
            $table->dropColumn('maxLocalidadCompra');
        });
    }
}