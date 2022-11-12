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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unique();
            $table->string("nombre", 255);
            $table->string("serie",15)->unique();
            $table->float("precio_compra", 8, 4, true)->unsigned();
            $table->float("precio_existencia", 4, 2, true)->unsigned();
            $table->integer("existencia")->unsigned();
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
