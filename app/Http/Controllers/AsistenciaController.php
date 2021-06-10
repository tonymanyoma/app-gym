<?php

namespace App\Http\Controllers;

use App\Asistencia;
use Illuminate\Http\Request;
use DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->wantsJson()){

            try{

                $asistencias = DB::table('asistencias as A')
                    ->join('usuarios as U', 'A.id_cliente', '=', 'U.id')

                    ->select(
                        'A.*',
                        'U.nombre_completo as nombre_completo',

                        )
                    ->where('A.id_estado', 1)
                    ->orderBy('A.id','DESC')
                    ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }

            return $asistencias;


        }else{
            return redirect('/');
        }
    }


    public function crear_asistencia(Request $request)
    {
        if($request->wantsJson()){

            try{

            $now = new \DateTime();

            $hour = $now->format('H:i');

            $asistencia = new Asistencia();

            $asistencia->id_cliente = $request->id_cliente;
            $asistencia->fecha = $request->fecha;
            $asistencia->hora = $hour;
            $asistencia->id_estado = 1;

            if( $hour >= '6:00' && $hour <= '11:59'){

                $jornada = 'mañana';

            }else if( $hour >= '12:00' && $hour <= '17:59'){

                $jornada = 'tarde';

            }else if( $hour >= '18:00' && $hour <= '23:59'){

                $jornada = 'tarde';
            }

            $asistencia->jornada = $jornada;



            $asistencia->save();

            return 'ok';


        }catch(QueryException $queryException){

            return $queryException->getMessage();
        }



    }

}


public function eliminar_asistencia(Request $request)
{


    if($request->wantsJson()){


        $asistencia = Asistencia::find($request->id);
        $asistencia->id_estado = 2;

        $asistencia->save();

        return 'ok';

    }else{
        return redirect('/');
    }


}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
