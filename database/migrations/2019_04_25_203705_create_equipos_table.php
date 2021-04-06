<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre', 100);
            $table->string('marca', 100)->nullable();
            $table->string('modelo', 50)->nullable();
            $table->string('activo_fijo', 50)->nullable();
            $table->string('serie', 25)->nullable();
            $table->integer('clasificacion_id')->unsigned();
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');

            $table->text('imagen')->nullable();
            $table->string('proveedor')->nullable();

            $table->string('ubicacion')->nullable();
            $table->string('piso')->nullable();

            $table->boolean('condicion')->default(true)->nullable();

            $table->date('fecha_entrega_servicio')->nullable();
            $table->string('motivo_baja')->nullable();
            $table->date('fecha_baja')->nullable();
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
        Schema::dropIfExists('equipos');
    }
}
