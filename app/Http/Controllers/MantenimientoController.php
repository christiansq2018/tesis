<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('mantenimiento.index', [
        'mantenimientos' => Mantenimiento::ofMonth()->get()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $equipos = \App\Equipo::all();
      $proveedores = \App\Proveedor::all();
      return view('mantenimiento.create', compact('equipos','proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      $mantenimiento = new Mantenimiento([
        'proveedor_id'      => $request->proveedor_id,
        'equipo_id'         => $request->equipo_id,
        'tipo'              => $request->tipo
      ]);

      $mantenimiento->frecuencia = $request->rate;
      $mantenimiento->mes_vencimiento = $request->mes_vencimiento;
      $mantenimiento->save();

      return redirect()->route('mantenimiento.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $matenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
      $mantenimiento->frecuencia = $request->rate;
      $mantenimiento->mes_vencimiento = $request->mes_vencimiento;
      $mantenimiento->save();

      return response()->json(['data' => $mantenimiento]);
    }

    /**
     * Delete the specified resource in storage.
     *
     * @param  \App\Mantenimiento  $matenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento){
      $mantenimiento->delete();
      return redirect()->route('mantenimiento.index');
      //return response()->json(['data' => "Mantenimiento $mantenimiento->id eliminado exitosamente"]);
    }
}