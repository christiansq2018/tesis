<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalle_ventas';
    protected $fillable = [
        'venta_id', 
        'equipo_id',
        'cantidad',
        'precio',
        'descuento'
    ];
    
    public $timestamps = false;
}
