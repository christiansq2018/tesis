<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    
    protected $fillable = [
      'activo_fijo',
      'condicion',
      'nombre',
      'marca',
      'modelo',
      'ubicacion',
      'piso',
      'clasificacion_id',
      'motivo_baja',
      'fecha_baja',
      'fecha_entrega_servicio',
      'imagen',
      'proveedor',
    ];

    public function mantenimientos(){
      return $this->hasMany('App\Mantenimiento');
    }
    
    public function clasificacion(){
      return $this->belongsTo('App\Clasificacion');
    }
}
