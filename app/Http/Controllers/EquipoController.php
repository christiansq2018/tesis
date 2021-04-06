<?php

namespace App\Http\Controllers;

use App\Clasificacion;
use Illuminate\Http\Request;
use App\Equipo;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Rap2hpoutre\FastExcel\FastExcel;

class EquipoController extends Controller
{
  //
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $buscarTexto = trim($request->get('buscarTexto'));
    $equipos = Equipo::orderBy('nombre')->with('clasificacion')->paginate(20);
    $clasificaciones = Clasificacion::all();
    return view('equipo.index', compact('equipos','clasificaciones','buscarTexto'));

    // if ($request) {
    //   $sql = trim($request->get('buscarTexto'));
    //   $equipos = DB::table('equipos as p')
    //     ->join('clasificaciones as c', 'p.clasificacion_id', '=', 'c.id')
    //     ->select('p.id', 'p.clasificacion_id', 'p.nombre', 'p.precio_venta', 'p.codigo', 'p.stock', 'p.imagen', 'p.condicion', 'c.nombre as clasificacion')
    //     ->where('p.nombre', 'LIKE', '%' . $sql . '%')
    //     ->orwhere('p.codigo', 'LIKE', '%' . $sql . '%')
    //     ->orderBy('p.id', 'desc')
    //     ->paginate(3);

    //   /*listar las clasificaciones en ventana modal*/
    //   $clasificaciones = DB::table('clasificaciones')
    //     ->select('id', 'nombre', 'descripcion')
    //     ->where('condicion', '=', '1')->get();

    //   return view('equipo.index', ["equipos" => $equipos, "clasificaciones" => $clasificaciones, "buscarTexto" => $sql]);

    //   //return $equipos;
    // }
  }



  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    $equipo = new Equipo();
    $equipo->clasificacion_id = $request->clasificacion_id;
    $equipo->nombre = $request->nombre;
    $equipo->serie = $request->serie;
    $equipo->activo_fijo = $request->activo_fijo;
    $equipo->marca = $request->marca;
    $equipo->modelo = $request->modelo;
    $equipo->ubicacion = $request->ubicacion;
    $equipo->piso = $request->piso;
    $equipo->fecha_baja = $request->fecha_baja;
    $equipo->motivo_baja = $request->motivo_baja;
    $equipo->fecha_entrega_servicio = $request->fecha_entrega_servicio;

    //Handle File Upload
    if ($request->hasFile('imagen')) {
      $extension       = $request->file('imagen')->guessClientExtension();
      $fileNameToStore = time() . '.' . $extension;
      $request->file('imagen')->storeAs('public/img/equipo', $fileNameToStore);
    } else {
      $fileNameToStore = "noimagen.jpg";
    }

    $equipo->imagen = $fileNameToStore;
    $equipo->save();
    return Redirect::to("equipo");
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    //
    $equipo = Equipo::findOrFail($request->id_equipo);
    $equipo->clasificacion_id = $request->clasificacion_id;
    $equipo->nombre = $request->nombre;
    $equipo->serie = $request->serie;
    $equipo->activo_fijo = $request->activo_fijo;
    $equipo->marca = $request->marca;
    $equipo->modelo = $request->modelo;
    $equipo->ubicacion = $request->ubicacion;
    $equipo->piso = $request->piso;
    $equipo->fecha_baja = $request->fecha_baja;
    $equipo->motivo_baja = $request->motivo_baja;
    $equipo->fecha_entrega_servicio = $request->fecha_entrega_servicio;

    //Handle File Upload

    if ($request->hasFile('imagen')) {

      if ($equipo->imagen && $equipo->imagen != 'noimagen.jpg') {
        Storage::delete('app/public/img/equipo' . $equipo->imagen);
      }

      $filenamewithExt = $request->file('imagen')->getClientOriginalName();
      $extension = $request->file('imagen')->guessClientExtension();
      $fileNameToStore = time() . '.' . $extension;
      $request->file('imagen')->storeAs('public/img/equipo', $fileNameToStore);
    } else {
      $fileNameToStore = $equipo->imagen;
    }

    $equipo->imagen = $fileNameToStore;
    $equipo->save();
    return Redirect::to("equipo");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, Equipo $equipo)
  {
    $equipo->condicion = ($equipo->condicion == 0) ? 1 : 0;
    $equipo->save();
    return Redirect::to("equipo");
  }

  public function listarPdf()
  {
    // $equipos = Equipo::join('clasificaciones', 'equipos.clasificacion_id', '=', 'clasificaciones.id')
    //   ->select('equipos.id', 'equipos.clasificacion_id', 'equipos.codigo', 'equipos.nombre', 'clasificaciones.nombre as nombre_clasificacion', 'equipos.stock', 'equipos.condicion')
    //   ->orderBy('equipos.nombre', 'desc')->get();

    $equipos = Equipo::select([
      'id',
      'activo_fijo',
      'nombre',
      'marca',
      'modelo',
      'serie',
      'ubicacion',
      'piso',
      'fecha_entrega_servicio',
      'clasificacion_id'
    ])->with([
      'clasificacion' => function($query){
        return $query->select(['id', 'nombre']);
      }
    ])->orderBy('nombre', 'desc')->get();

    $cont = Equipo::count();

    $pdf = \PDF::loadView('pdf.equipospdf', ['equipos' => $equipos, 'cont' => $cont]);
    return $pdf->download('equipos.pdf');
  }

  public function import(Request $request)
  {
    if( $request->hasFile('file') ){
      $path = $request->file('file')->store('public/equipos');
    }

    $equipos = (new FastExcel)->import( storage_path("app/$path"), function ($line) {
      return Equipo::create([
        'clasificacion_id'       => 1,
        'nombre'                 => $line['EQUIPO'],
        'marca'                  => $line['MARCA'],
        'modelo'                 => $line['MODELO'],
        'activo_fijo'            => $line['ACTIVO FIJO'],
        'serie'                  => $line['SERIE'],
        'ubicacion'              => $line['UBICACIÓN'],
        'piso'                   => $line['PISO'],
        'fecha_entrega_servicio' => $line['FECHA DE ENTREGA AL SERVICIO'] != 'N/I' ? \Carbon\Carbon::parse( $line['FECHA DE ENTREGA AL SERVICIO'] )->format('Y-m-d') : null,
        'motivo_baja'            => $line['MOTIVO DE BAJA'],
        'fecha_baja'             => $line['FECHA DE BAJA'] != 'N/I' ? \Carbon\Carbon::parse( $line['FECHA DE BAJA'] )->format('Y-m-d') : null,
        'proveedor'              => $line['PROVEEDOR DE MANTENIMIENTO']
      ]);
    });

    dd( $equipos );
  }
}
