<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('mantenimiento_id');
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')->onDelete('cascade');
            $table->dateTime('fecha_aplicacion')->nullable();
            $table->integer('tiempo_respuesta')->nullable();
            $table->time('tiempo_parado_mantenimiento')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicaciones');
    }
}
