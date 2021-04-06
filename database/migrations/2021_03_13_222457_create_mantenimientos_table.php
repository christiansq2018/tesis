<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimientosTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mantenimientos', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->timestamps();
      $table->enum('tipo', ['preventivo', 'correctivo', 'metrologia', 'calificacion'])->default('preventivo');

      $table->integer('frecuencia')->unsigned();

      $table->integer('equipo_id')->unsigned();
      $table->foreign('equipo_id')->references('id')->on('equipos');

      $table->integer('proveedor_id')->unsigned();
      $table->foreign('proveedor_id')->references('id')->on('proveedores');

      $table->date('fecha_vencimiento');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('mantenimientos');
  }
}
