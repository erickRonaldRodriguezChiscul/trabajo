<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class MostrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function taxista(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        $personas = DB::table('persona')->join('users',function ($join) {
            $join->on('persona.id', '=', 'users.idPersona')
            ->where('users.tipo','=',2);
        })
        ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
        ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
        ->paginate(15);
        return view("taxista.mostrar",['personas'=>$personas]);
    }

    public function registrarTaxista()
    {
        return view("taxista.registrar");
    }

    //Mostrar respectivos del Contacto
    public function registrarContacto()
    {
        return view("contacto.registrar");
    }

    public function taxistaContacto(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        $personas = DB::table('persona')->join('users',function ($join) {
            $join->on('persona.id', '=', 'users.idPersona')
            ->where('users.tipo','=',2);
        })
        ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
        ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
        ->paginate(15);
        return view("contacto.taxistaMostrar",['personas'=>$personas]);
    }

    public function minitaxistaContacto(Request $request){
        $palabra = $request['query'];
        $personas = DB::table('persona')->join('users',function ($join) {
            $join->on('persona.id', '=', 'users.idPersona')
            ->where('users.tipo','=',2);
        })
        ->where('persona.nombre','LIKE','%'.$palabra.'%')
        ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
        ->select('persona.id','persona.nombre','persona.apellidos')
        ->get();
        return view("contacto.miniTaxista",['personas'=>$personas]);
    }

    public function contacto(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $contacto = DB::table('persona')->join('contacto',function ($join) {
                $join->on('persona.id', '=', 'contacto.idTaxista');
            })
            ->where('contacto.nombreContacto', 'LIKE', '%'.$palabra.'%')
            ->orwhere('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('contacto.apellidosContacto', 'LIKE', '%'.$palabra.'%')
            ->select('contacto.*','persona.nombre')
            ->paginate(15);
        }elseif(Auth::user()->tipo == 2){
            $contacto = DB::table('contacto')->join('persona',function ($join) {
                $join->on('contacto.idTaxista', '=', 'persona.id')
                ->where('persona.id',Auth::user()->idPersona)
                ->where('contacto.estado','S');
            })
            ->where('contacto.nombreContacto', 'LIKE', '%'.$palabra.'%')
            ->orWhere('contacto.apellidosContacto', 'LIKE', '%'.$palabra.'%')
            ->select('contacto.*')
            ->paginate(15);
        }
        
        return view("contacto.mostrar",['contactos'=>$contacto]);
    }

    public function vehiculo(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $contacto = DB::table('persona')->join('vehiculo',function ($join) {
                $join->on('persona.id', '=', 'vehiculo.idPersona');
            })
            ->where('persona.nombre', 'LIKE','%'.$palabra.'%')
            ->orWhere('vehiculo.marcaVehiculo','LIKE', '%'.$palabra.'%')
            ->orWhere('vehiculo.placaVehiculo','LIKE', '%'.$palabra.'%')
            ->select('vehiculo.*','persona.nombre')
            ->paginate(15);
        }elseif(Auth::user()->tipo == 2){
            $contacto = DB::table('vehiculo')->join('persona',function ($join) {
                $join->on('vehiculo.idPersona','=','persona.id')
                ->where('persona.id',Auth::user()->idPersona)
                ->where('vehiculo.estado','S');
            })
            ->where('vehiculo.marcaVehiculo','LIKE','%'.$palabra.'%')
            ->orWhere('vehiculo.placaVehiculo','LIKE','%'.$palabra.'%')
            ->select('vehiculo.*')
            ->paginate(15);
        }
        return view("vehiculo.mostrar",['vehiculos'=>$contacto]);
    }

    public function registrarVehiculo()
    {
        return view("vehiculo.registrar");
    }

    public function cliente(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $clientes = DB::table('users')->join('persona',function($join){
                $join->on('users.idPersona','=','persona.id');
            })->join('cliente',function($join){
                $join->on('persona.id','=','cliente.idCliente');
            })
            ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
            ->select('cliente.celularCliente','persona.*','users.estado')
            ->paginate(15);
        }elseif(Auth::user()->tipo == 2){
            $clientes = DB::table('users')->join('persona',function($join){
                $join->on('users.idPersona','=','persona.id')
                ->where('users.estado','=','S');
            })->join('cliente',function($join){
                $join->on('persona.id','=','cliente.idCliente')
                ->where('cliente.idPersona',Auth::user()->idPersona);
            })
            ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
            ->select('cliente.celularCliente','persona.*','users.estado')
            ->paginate(15);
        }
        return view("cliente.mostrar",['clientes'=>$clientes]);
    }

    public function registrarCliente()
    {
        return view("cliente.registrar");
    }

    public function servicio(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $servicios = DB::table('servicio')
            ->where('servicio.nombreServicio', 'LIKE', '%'.$palabra.'%')
            ->paginate(15);
        }
        return view("servicio.mostrar",['servicios'=>$servicios]);
    }

    public function registrarServicio()
    {
        return view("servicio.registrar");
    }

    public function programacion(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $servicios = DB::table('servicio')
            ->where('servicio.nombreServicio', 'LIKE', '%'.$palabra.'%')
            ->paginate(15);
        }
        return view("servicio.mostrar",['servicios'=>$servicios]);
    }

    public function minitaxistaProgramacion(Request $request){
        $palabra = $request['query'];
        $personas = DB::table('persona')->join('users',function ($join) {
            $join->on('persona.id', '=', 'users.idPersona')
            ->where('users.tipo','=',2)
            ->where('users.estado','=','S');
        })
        ->where('persona.nombre','LIKE','%'.$palabra.'%')
        ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
        ->select('persona.id','persona.nombre','persona.apellidos')
        ->get();
        return view("programacion.mostrarPersona",['personas'=>$personas]);
    }

    public function miniServicioProgramacion(Request $request){
        $palabra = $request['query'];
        $servicios = DB::table('servicio')
        ->where('estado','=','S')
        ->where('nombreServicio','LIKE','%'.$palabra.'%')
        ->get();
        return view("programacion.mostrarServicio",['servicios'=>$servicios]);
    }

    //mostrar todo referentes a datos (telefono, direccion)

    public function dato(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        //$tipo = $tipo['tipo'];
        if(Auth::user()->tipo == 1){
            $datos = DB::table('persona')->join('dato',function($join){
                $join->on('persona.id','=','dato.idPersona');
            })
            ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
            ->orWhere('dato.descripcion','LIKE','%'.$palabra.'%')
            ->paginate(15);
        }elseif(Auth::user()->tipo == 2){
            $datos = DB::table('persona')->join('dato',function($join){
                $join->on('persona.id','=','dato.idPersona')
                ->where('dato.estado','=','S');
            })
            ->where('persona.idPersona',Auth::user()->idPersona)
            ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
            ->orWhere('dato.descripcion','LIKE','%'.$palabra.'%')
            ->paginate(15);
        }
        return view("dato.mostrar",['datos'=>$datos]);
    }

    public function registrarDato()
    {
        return view("dato.registrar");
    }

    public function vehiculoRevision(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $contacto = DB::table('persona')->join('vehiculo',function ($join) {
                $join->on('persona.id', '=', 'vehiculo.idPersona');
            })
            ->where('persona.nombre', 'LIKE','%'.$palabra.'%')
            ->orWhere('vehiculo.marcaVehiculo','LIKE', '%'.$palabra.'%')
            ->orWhere('vehiculo.placaVehiculo','LIKE', '%'.$palabra.'%')
            ->select('vehiculo.*','persona.nombre')
            ->paginate(15);
        }elseif(Auth::user()->tipo == 2){
            $contacto = DB::table('vehiculo')->join('persona',function ($join) {
                $join->on('vehiculo.idPersona','=','persona.id')
                ->where('persona.id',Auth::user()->idPersona)
                ->where('vehiculo.estado','S');
            })
            ->where('vehiculo.marcaVehiculo','LIKE','%'.$palabra.'%')
            ->orWhere('vehiculo.placaVehiculo','LIKE','%'.$palabra.'%')
            ->select('vehiculo.*')
            ->paginate(15);
        }
        return view("revision.mostrarVehiculo",['vehiculos'=>$contacto]);
    }

    public function tarifa(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $contacto = DB::table('tarifa')
            ->where('tipoTarifa','LIKE','%'.$palabra.'%')
            ->paginate(15);
        }
        return view("tarifa.mostrar",['tarifas'=>$contacto]);
    }

    public function registrarTarifa()
    {
        return view("tarifa.registrar");
    }
}