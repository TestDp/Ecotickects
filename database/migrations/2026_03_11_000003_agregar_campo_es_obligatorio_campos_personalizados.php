<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCampoEsObligatorioCamposPersonalizados extends Migration
{
    public function up()
    {
        Schema::table('tbl_campos_personalizados', function (Blueprint $table) {
            $table->boolean('esObligatorio')->default(false)->after('opciones');
        });
    }

    public function down()
    {
        Schema::table('tbl_campos_personalizados', function (Blueprint $table) {
            $table->dropColumn('esObligatorio');
        });
    }
}
