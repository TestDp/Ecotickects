<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoPrecioBoletaPadreId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_PreciosBoletas', function (Blueprint $table) {
            $table->integer('PrecioBoletaPadre_Id')->nullable()->unsigned();
            $table->foreign('PrecioBoletaPadre_Id')->references('id')->on('Tbl_PreciosBoletas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tbl_PreciosBoletas', function (Blueprint $table) {
            //
        });
    }
}
