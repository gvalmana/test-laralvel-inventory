<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('productos', function (Blueprint $table) {
            $table->id()->unique();
            $table->string("nombre", 255);
            $table->string("serie",15)->unique();
            $table->double("precio_compra", 16, 4, true)->unsigned();
            $table->double("precio_venta", 16, 4, true)->unsigned();
            $table->integer("cantidad")->unsigned();
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
        //
    }
};
