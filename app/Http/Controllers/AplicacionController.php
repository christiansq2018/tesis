<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aplicacion;
use \App\Mantenimiento;

class AplicacionController extends Controller
{
  public function store(Request $request){
    $mantenimiento = Mantenimiento::findOrFail( $request->mantenimiento_id );
    $mantenimiento->update([
      'fecha_vencimiento' => now()->startOfMonth()->addMonths( $mantenimiento->frecuencia )
    ]);

    $aplicacion = Aplicacion::create([
      'fecha_aplicacion' => now(),
      'mantenimiento_id' => $mantenimiento->id,
      'tiempo_parado_mantenimiento' => now()->startOfDay()->addHours( $request->disabled_hours )->addMinutes( $request->disabled_minutes )->format('h:i:s'),
      'tiempo_respuesta' => now()->format('d'),
    ]);

    return response()->json(['data' => $aplicacion]);
  }

  public function downloadPDF(Request $request, Aplicacion $aplicacion){
    $aplicacion->load('mantenimiento');
    $pdf = \PDF::loadView('pdf.mantenimiento', ['aplicacion' => $aplicacion]);
    return $pdf->download("mantenimiento-{$aplicacion->id}.pdf");
  }
}
