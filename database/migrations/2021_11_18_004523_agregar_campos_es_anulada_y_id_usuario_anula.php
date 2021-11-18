<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCamposEsAnuladaYIdUsuarioAnula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_asistentesXeventos', function (Blueprint $table) {
            $table->boolean('esAnulado')->default(0);
            $table->integer('IdUsuarioAnula')->nullable()->unsigned();
            $table->foreign('IdUsuarioAnula')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_asistentesXeventos', function (Blueprint $table) {
            //
        });
    }
}
