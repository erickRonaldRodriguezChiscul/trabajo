<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EliminarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function eliminarTaxista(Request $request)
    {
        if ($request->ajax()) {
            DB::table('users')
            ->where('id', $request['id'])
            ->update(['estado' => 'N']);
            return response()->json([
                'estado' => 'ok'
            ]);
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }
    public function eliminarContacto(Request $request){
        if ($request->ajax()) {
            DB::table('contacto')
            ->where('id', $request['id'])
            ->update(['estado' => 'N']);

            if(Auth::user()->tipo == 2){
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '2'
                ]);
            }else{
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '1'
                ]);
            }
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }

    public function eliminarVehiculo(Request $request){
        if ($request->ajax()) {
            DB::table('vehiculo')
            ->where('idVehiculo', $request['idVehiculo'])
            ->update(['estado' => 'N']);

            if(Auth::user()->tipo == 2){    
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '2'
                ]);
            }else{
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '1'
                ]);
            }
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }

    public function eliminarCliente(Request $request){
        if ($request->ajax()) {
            DB::table('users')
            ->where('idPersona', $request['id'])
            ->update(['estado' => 'N']);

            if(Auth::user()->tipo == 2){    
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '2'
                ]);
            }else{
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '1'
                ]);
            }
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }

    public function eliminarDato(Request $request){
        if ($request->ajax()) {
            DB::table('Dato')
            ->where('idDato', $request['id'])
            ->update(['estado' => 'N']);

            if(Auth::user()->tipo == 2){
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '2'
                ]);
            }else{
                return response()->json([
                    'estado' => 'ok',
                    'tipo' => '1'
                ]);
            }
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }
}
