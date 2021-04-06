<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
  protected $table = 'aplicaciones';

  protected $fillable = [
    'mantenimiento_id',
    'fecha_aplicacion',
    'tiempo_parado_mantenimiento',
    'tiempo_respuesta'
  ];

  public function mantenimiento(){
    return $this->belongsTo('App\Mantenimiento');
  }
}
