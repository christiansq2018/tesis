<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clasificacion;
use Illuminate\Support\Facades\Redirect;
use DB;


class ClasificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $clasificaciones=DB::table('clasificaciones')->where('nombre','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(3);
            return view('clasificacion.index',["clasificaciones"=>$clasificaciones,"buscarTexto"=>$sql]);
            //return $clasificaciones;
        }
       
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
        $clasificacion= new Clasificacion();
        $clasificacion->nombre= $request->nombre;
        $clasificacion->descripcion= $request->descripcion;
        $clasificacion->condicion= '1';
        $clasificacion->save();
        return Redirect::to("clasificacion");
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
        $clasificacion= Clasificacion::findOrFail($request->id_clasificacion);
        $clasificacion->nombre= $request->nombre;
        $clasificacion->descripcion= $request->descripcion;
        $clasificacion->condicion= '1';
        $clasificacion->save();
        return Redirect::to("clasificacion");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 
            $clasificacion= Clasificacion::findOrFail($request->id_clasificacion);

            if($clasificacion->condicion=="1"){
                
                $clasificacion->condicion= '0';
                $clasificacion->save();
                return Redirect::to("clasificacion");
        
            } else{

                $clasificacion->condicion= '1';
                $clasificacion->save();
                return Redirect::to("clasificacion");

            }
    }
}
