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
            })->join('licencia',function($join){
                $join->on('persona.id','=','licencia.idPersona');
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

    public function recuperarServicio(Request $request){
        if($request->ajax()){

            $servicio = DB::table('servicio')
            ->where('servicio.idServicio',$request['idEditar'])
            ->get();
            return  response()->json([
                'servicio' => $servicio
            ]);
        }
    }

    public function recuperarRevision(Request $request){
        if($request->ajax()){
            $page = $request['page'];
            $palabra = $request['palabra'];
            $revision = DB::table('revisiontecnica')->join('vehiculo',function ($join) {
                $join->on('revisiontecnica.idVehiculo','=','vehiculo.idVehiculo');
            })
            ->where('revisiontecnica.idVehiculo',$request['idEditar'])
            ->where('revisiontecnica.entidadRevision', 'LIKE', '%'.$palabra.'%')
            ->orderBy('revisiontecnica.idRevision', 'desc')
            ->select('revisiontecnica.*','vehiculo.revisionActual')
            ->paginate(15);
            return view("revision.mostrar",['revisiones'=>$revision]);
        }
    }

    public function recuperarSoat(Request $request){
        if($request->ajax()){
            $page = $request['page'];
            $palabra = $request['palabra'];
            $soat = DB::table('soat')->join('vehiculo',function ($join) {
                $join->on('soat.idVehiculo','=','vehiculo.idVehiculo');
            })
            ->where('soat.idVehiculo',$request['idEditar'])
            ->where('soat.entidadSoat', 'LIKE', '%'.$palabra.'%')
            ->orderBy('soat.idSoat', 'desc')
            ->select('soat.*','vehiculo.soatActual')
            ->paginate(15);
            return view("soat.mostrar",['soats'=>$soat]);
        }
    }

    public function recuperarSeguro(Request $request){
        if($request->ajax()){
            $page = $request['page'];
            $palabra = $request['palabra'];
            $seguros= DB::table('seguroriesgo')->join('vehiculo',function ($join) {
                $join->on('seguroriesgo.idVehiculo','=','vehiculo.idVehiculo');
            })
            ->where('seguroriesgo.idVehiculo',$request['idEditar'])
            ->where('seguroriesgo.entidadSeguro', 'LIKE', '%'.$palabra.'%')
            ->orderBy('seguroriesgo.idSeguro', 'desc')
            ->select('seguroriesgo.*','vehiculo.seguroActual')
            ->paginate(15);
            return view("seguro.mostrar",['seguros'=>$seguros]);
        }
    }
    public function recuperarTarifa(Request $request){
        if($request->ajax()){
            $tarifa = DB::table('tarifa')
            ->where('idTarifa',$request['idEditar'])
            ->get();
            return  response()->json([
                'tarifa' => $tarifa
            ]);
        }
    }

    public function recuperarProgramacion(Request $request){
        if($request->ajax()){
            $programacion = DB::table('programacion')
            ->join('progperso',function ($join) {
                $join->on('programacion.idProgramacion','=','progperso.IdProgramacion');
            })
            ->where('programacion.idProgramacion',$request['idEditar'])
            ->get();
            return  response()->json([
                'programacion' => $programacion
            ]);
        }
    }
}