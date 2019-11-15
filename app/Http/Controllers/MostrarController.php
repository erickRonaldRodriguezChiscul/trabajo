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

    public function contacto(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        if(Auth::user()->tipo == 1){
            $contacto = DB::table('persona')->join('contacto',function ($join) {
                $join->on('persona.id', '=', 'contacto.idTaxista');
            })
            ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
            ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
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

}
