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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id()->unique();
            $table->integer("cantidad")->unsigned();
            $table->foreignId("producto_id")->constrained();
            $table->double("valor")->unsigned()->default(0);            
            $table->timestamps();
            $table->softDeletes();
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
