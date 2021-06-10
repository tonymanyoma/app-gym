<?php

namespace App\Http\Controllers;

use App\Membresia;
use App\DetalleMembresia;
use App\Usuario;
use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;

class MembresiaController extends Controller
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

                $membresias = DB::table('membresias as M')
                    ->join('usuarios as C', 'M.id_usuario', '=', 'C.id')
                    ->join('plans as P', 'M.id_plan', '=', 'P.id')
                    ->join('usuarios as T', 'M.id_admin', '=', 'T.id')
                    ->join('estado_membresia as E', 'M.id_estado_membresia', '=', 'E.id')
                    ->select(
                        'M.*',
                        'P.nombre as nombre_plan',
                        'C.nombre_completo as nombre_cliente',
                        'T.nombre_completo as admin',
                        'E.nombre as estado_membresia'

                        )
                    ->where('M.id_estado', 1)
                    ->orderBy('M.id','DESC')
                    ->get();


            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            return $membresias;


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


    public function crear_membresia(Request $request)
    {

        if($request->wantsJson()){

            try{

            $validar_membresia = Membresia::where('id_usuario', '=', $request->id_cliente)->first();

            if( !empty($validar_membresia) && ($validar_membresia->id_estado == 1)){

                return response()->json(['error' => 'Ya cuenta con una membresia registrada',
                                 'code' => 1 ], 401);
            }else{

            $user = Auth::user()->id;

            $membresia = new Membresia();

            $membresia->fecha_inicio = $request->fecha_inicio;
            $membresia->id_usuario= $request->id_cliente;
            $membresia->id_plan = $request->id_plan;
            $membresia->valor = $request->valor;
            $membresia->id_estado_membresia = $request->id_estado_membresia;
            $membresia->id_estado = $request->id_estado;
            $membresia->id_admin = $user;

            if( $request->id_plan == 1){

                $end_date = $request->fecha_inicio;

            }else if($request->id_plan == 2){

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio )->addday(+ 15)->toDateString();

            }else if($request->id_plan == 3){

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio )->addMonth()->toDateString();
            }


            $membresia->fecha_fin = $end_date;


            $membresia->save();


           /* $detallemembresia = new DetalleMembresia();

            $detallemembresia->id_membresia = $membresia->id;
            $detallemembresia->save();*/

            return 'ok';

        }


        }catch(QueryException $queryException){

            return $queryException->getMessage();
        }



    }
    }


    public function renovar_membresia(Request $request)
    {
        if($request->wantsJson()){

            try{


            $membresia = Membresia::find($request->id);

            $membresia->fecha_inicio = $request->fecha_inicio;
            $membresia->id_plan = $request->id_plan;

            if( $request->id_plan == 1){

                $end_date = $request->fecha_inicio;

            }else if($request->id_plan == 2){

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio )->addday(+ 15)->toDateString();

            }else if($request->id_plan == 3){

                $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',$request->fecha_inicio )->addMonth()->toDateString();
            }


            $membresia->fecha_fin = $end_date;


            $membresia->save();

            $detallemembresia = new DetalleMembresia();

            $detallemembresia->id_membresia = $membresia->id;
            $detallemembresia->save();

            return 'ok';


        }catch(QueryException $queryException){

            return $queryException->getMessage();
        }



    }

}

    public function eliminar_membresia(Request $request)
    {
        if($request->wantsJson()){

            $membresia = Membresia::find($request->id);
            $membresia->id_estado = 2;

            $membresia->save();

        }else{
            return redirect('/');
        }
    }


    public function generar_recibo(Request $request, $id)
    {

                    $membresia = DB::table('membresias as M')
                    ->join('usuarios as C', 'M.id_usuario', '=', 'C.id')
                    ->join('plans as P', 'M.id_plan', '=', 'P.id')
                    ->join('usuarios as T', 'M.id_admin', '=', 'T.id')
                    ->join('estado_membresia as E', 'M.id_estado_membresia', '=', 'E.id')
                    ->select(
                        'M.*',
                        'P.nombre as nombre_plan',
                        'C.nombre_completo as nombre_cliente',
                        'T.nombre_completo as admin',
                        'E.nombre as estado_membresia'

                        )
                    ->where('M.id', $id)
                    ->first();


                    $pdf = PDF::loadView('pdf.recibo',compact('membresia'));
                    return $pdf->download('document.pdf');
    }


    public function membresias_vencidas(Request $request)
    {

        $membresia = DB::table('membresias as M')
                    ->where('M.id_estado_membresia', 2)
                    ->where('M.id_estado', 1)
                    ->first();

        if( !empty($membresia) ){

            return 1;

        }else{

            return 0;
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
    }

    public function prueba(Request $request)
    {



        $membresia = DB::table('membresias as M')
                    ->where('M.id_estado_membresia', 2)
                    ->where('M.id_estado', 1)
                    ->get();

                    if( !empty($membresia) ){

                        return 1;

                    }else{

                        return 0;
                    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function show(Membresia $membresia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function edit(Membresia $membresia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membresia $membresia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membresia  $membresia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membresia $membresia)
    {
        //
    }
}
