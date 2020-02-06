<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoPrecioBoleta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_InfoPagos', function (Blueprint $table) {
            $table->integer('PrecioBoleta_id')->nullable()->unsigned();
            $table->foreign('PrecioBoleta_id')->references('id')->on('Tbl_PreciosBoletas');
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
