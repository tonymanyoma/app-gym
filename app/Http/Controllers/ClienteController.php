<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use DB;
use Exception;
use Carbon\Carbon;

class ClienteController extends Controller
{

    public function index(Request $request)
    {
        if($request->wantsJson()){

            try{

                $clientes = DB::table('usuarios as U')
                    ->join('tipo_documentos as T', 'U.id_tipo_documento', '=', 'T.id')
                    ->join('estados as E', 'U.id_estado', '=', 'E.id')
                    ->select(
                        'U.*',
                        'T.nombre as tipo_documento',
                        'E.nombre as nombre_estado',

                        )
                    ->where('U.id_estado','=',1)
                    ->where('U.id_role','=',2)
                    ->orderBy('U.id','DESC')
                    ->get();




            }catch(QueryException $queryException){

                return $queryException->getMessage();
            }



            //return response()->json($response);*/

            return $clientes;


        }else{
            return redirect('/');
        }
    }


    public function crear_cliente(Request $request)
    {
        if($request->wantsJson()){

            try{

            $user = new Usuario();

            $user->id_tipo_documento = $request->id_tipo_documento;
            $user->numero_documento = $request->numero_documento;
            $user->nombre_completo = $request->nombre_completo;
            $user->telefono = $request->telefono;
            $user->direccion = $request->direccion;
            $user->id_estado = $request->id_estado;
            $user->id_role = $request->id_role;
            $user->sexo = $request->sexo;
            $user->fecha_nacimiento = $request->fecha_nacimiento;

            $year = Carbon::parse($request->fecha_nacimiento)->format('Y');

            $user->year_nacimiento = $year;


            $user->save();

            return 'ok';


        }catch(QueryException $queryException){

            return $queryException->getMessage();
        }



    }

}

public function eliminar_cliente(Request $request)
    {

        if($request->wantsJson()){

            $usuario = Usuario::find($request->id);
            $usuario->id_estado = 2;

            $usuario->save();

        }else{
            return redirect('/');
        }


    }


    public function actualizar_cliente(Request $request)
    {
        if($request->wantsJson()){

            try{

            $user = Usuario::find($request->id);

            $user->id_tipo_documento = $request->id_tipo_documento;
            $user->numero_documento = $request->numero_documento;
            $user->nombre_completo = $request->nombre_completo;
            $user->telefono = $request->telefono;
            $user->direccion = $request->direccion;

            $user->sexo = $request->sexo;


            $user->save();

            return 'ok';


        }catch(QueryException $queryException){

            return $queryException->getMessage();
        }



    }

}


public function nombre_clientes(Request $request)
    {
        if($request->wantsJson()){

            $clientes = Usuario::select('id', 'nombre_completo')
            ->where('id_role',2)
            ->orderBy('id', 'asc')->get();

            return ['clientes' => $clientes];
        }else{
            return redirect('/');
        }
    }


}
