<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use DB;
use PDF;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporte_asistencia(Request $request)
    {
        $asistencias = DB::table('asistencias as A')
                    ->join('usuarios as U', 'A.id_cliente', '=', 'U.id')
                    ->select(
                        'A.*',
                        'U.nombre_completo as nombre_completo',

                        )
                    ->where('A.id_estado', 1)
                    ->where('A.fecha','=',$request->fecha_asistencia)
                    ->orderBy('A.id','DESC')
                    ->get();

                    $pdf = PDF::loadView('pdf.reporte_asistencia',compact('asistencias'));
                    return $pdf->download('document.pdf');


    }

    public function reporte_membresia(Request $request)
    {

            if( $request->id_cliente == 0 ){

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
                    ->where('M.fecha_creacion','=', $request->fecha_membresia)
                    ->orderBy('M.id','DESC')
                    ->get();

                    $pdf = PDF::loadView('pdf.reporte_membresia_fecha',compact('membresias'));
                    return $pdf->download('document.pdf');

           }else{

                    $membresias = DB::table('membresias as M')
                    ->join('usuarios as C', 'M.id_usuario', '=', 'C.id')
                    ->join('plans as P', 'M.id_plan', '=', 'P.id')
                    ->join('usuarios as T', 'M.id_admin', '=', 'T.id')
                    ->join('estado_membresia as E', 'M.id_estado_membresia', '=', 'E.id')
                    ->select(
                        'M.*',
                        'P.nombre as nombre_plan',

                        'E.nombre as estado_membresia'

                        )
                    ->where('M.id_estado', 1)
                    ->where('M.id_usuario','=', $request->id_cliente)
                    ->orderBy('M.id','DESC')
                    ->get();


                    $cliente = Usuario::find($request->id_cliente);

                    $pdf = PDF::loadView('pdf.reporte_membresia_cliente',compact('membresias','cliente'));
                    return $pdf->download('document.pdf');

            }


    }


}
