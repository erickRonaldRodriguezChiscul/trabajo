<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mapa extends Controller
{
    public function recuperarUbicacion(Request $request){
        if($request->ajax()){

            $ubicacion = DB::table('ubicacion')->join('persona',function($join){
                $join->on('ubicacion.idPersona','=','persona.id');
            })
            ->select('ubicacion.*','persona.nombre','persona.apellidos')
            ->get();
            return  response()->json([
                'ubicacion' => $ubicacion
            ]);
        }
    }
}
