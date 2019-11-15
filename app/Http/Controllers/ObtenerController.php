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
}
