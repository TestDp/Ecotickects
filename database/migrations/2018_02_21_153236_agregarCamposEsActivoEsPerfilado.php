<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCamposEsActivoEsPerfilado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_asistentesXeventos', function (Blueprint $table) {
            $table->boolean('esActivo');
            $table->boolean('esPerfilado');
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
