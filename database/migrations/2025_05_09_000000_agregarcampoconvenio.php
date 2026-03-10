<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoEsConveni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_PreciosBoletas', function (Blueprint $table) {
            $table->boolean('esConvenio')->default(0);
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
            $table->dropColumn('esConvenio');
        });
    }
}
