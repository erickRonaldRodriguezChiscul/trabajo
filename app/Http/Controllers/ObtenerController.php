<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\{User,Persona};
use Illuminate\Support\Facades\DB;

class ObtenerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function recuperarTaxista(Request $request){
        if($request->ajax()){
            $persona = DB::table('users')->join('persona',function($join){
                $join->on('users.idPersona', '=', 'persona.id');
            })
            ->where('users.id',$request['idEditar'])
            ->get();
            return  response()->json([
                'persona' => $persona
            ]);
        }
    }
    public function recuperarContacto(Request $request){
        if($request->ajax()){
            $contacto = DB::table('contacto')
            ->where('id',$request['idEditar'])
            ->get();
            return  response()->json([
                'contacto' => $contacto
            ]);
        }
    }
    public function recuperarVehiculo(Request $request){
        if($request->ajax()){
            $vehiculo = DB::table('vehiculo')
            ->where('idVehiculo',$request['idEditar'])
            ->get();
            return  response()->json([
                'vehiculo' => $vehiculo
            ]);
        }
    }

    public function recuperarCliente(Request $request){
        if($request->ajax()){

            $cliente = DB::table('users')->join('persona',function($join){
                $join->on('users.idPersona','=','persona.id');
            })->join('cliente',function($join){
                $join->on('persona.id','=','cliente.idCliente');
            })
            ->where('cliente.idCliente',$request['idEditar'])
            ->select('cliente.idPersona','cliente.celularCliente','persona.*','users.estado')
            ->get();
            return  response()->json([
                'cliente' => $cliente
            ]);
        }
    }
}
