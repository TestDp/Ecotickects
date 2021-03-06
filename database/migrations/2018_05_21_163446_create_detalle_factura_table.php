<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_DetalleFactura', function (Blueprint $table) {
            $table->increments('id');
            $table->double('subTotal');
            $table->integer('cantidad');
            $table->integer('Producto_id')->unsigned();
            $table->foreign('Producto_id')->references('id')->on('Tbl_Productos');
            $table->integer('Factura_id')->unsigned();
            $table->foreign('Factura_id')->references('id')->on('Tbl_Factura');
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
        Schema::dropIfExists('Tbl_DetalleFactura');
    }
}
