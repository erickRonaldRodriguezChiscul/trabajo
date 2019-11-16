<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class EditarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function editarTaxista(Request $request){
        if ($request->ajax()) {
            $credenciales = $this->validate(request(),[
                'name'=> 'required|string',
                'email' => 'required|string',
                'dni'=> 'required|string',
                'fecha'=> 'required|string',
                'apellidos' => 'required|string'
            ],['email.required'=>'El campo es requerido.',
                'dni.required' => 'El campo es requerido.',
                'name.required' => 'El campo es requerido.',
                'fecha.required' => 'El campo es requerido.']);
            if($request['password'] == ''){
                DB::table('users')
                ->where('id', $request['id'])
                ->update(['name' => $request['name'],
                    'email' => $request['email'],
                    'estado' => $request['estado']
                ]);
            }else{
                DB::table('users')
                ->where('id', $request['id'])
                ->update(['name' => $request['name'], 
                    'email' => $request['email'],
                    'estado' => $request['estado'],
                    'password' => Hash::make($request['password'])
                ]);
            }
            
            DB::table('persona')
            ->where('id', $request['idPersona'])
            ->update(['nombre' => $request['name'], 
                'apellidos' => $request['apellidos'],
                'email' => $request['email'],
                'dni' => $request['dni'],
                'sexo'=> $request['sexo'],
                'fechaNacimiento'=>$request['fecha']
            ]);
        }
    }

    public function editarContacto(Request $request){
        if ($request->ajax()) {
            $credenciales = $this->validate(request(),[
                'nombreContacto'=> 'required|string',
                'apellidosContacto'=> 'required|string',
                'celularContacto' => 'required|string',
            ],['nombreContacto.required'=>'El campo es requerido.',
                'apellidosContacto.required' => 'El campo es requerido.',
                'celularContacto.required' => 'El campo es requerido.'
            ]);
            if(Auth::user()->tipo == 2){
                DB::table('contacto')
                ->where('id', $request['idContacto'])
                ->update(['nombreContacto' => $request['nombreContacto'], 
                    'apellidosContacto' => $request['apellidosContacto'],
                    'celularContacto' => $request['celularContacto']
                ]);
            }elseif (Auth::user()->tipo == 1) {
                DB::table('contacto')
                ->where('id', $request['idContacto'])
                ->update(['nombreContacto' => $request['nombreContacto'], 
                    'apellidosContacto' => $request['apellidosContacto'],
                    'celularContacto' => $request['celularContacto'],
                    'idTaxista' => $request['idPersona']
                ]);
            }            
        }else{
            return false;
        }
    }

    public function editarVehiculo(Request $request){
        $credenciales = $this->validate(request(),[
            'revisionTecnica'=> 'required|string',
            'tipoVehiculo'=> 'required|string',
            'marcaVehiculo'=> 'required|string',
            'yearFabricacion'=> 'required|string',
            'placaVehiculo'=> 'required|string',
            'soat' => 'required|string'
        ],['revisionTecnica.required'=>'El campo es requerido.',
            'tipoVehiculo.required' => 'El campo es requerido.',
            'marcaVehiculo.required' => 'El campo es requerido.',
            'yearFabricacion.required' => 'El campo es requerido.',
            'placaVehiculo.required' => 'El campo es requerido.',
            'soat.required' => 'El campo es requerido.'
        ]);
        if ($request->ajax()) {
            if(Auth::user()->tipo == 2){
                DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update(['revisionTecnica' => $request['revisionTecnica'], 
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'marcaVehiculo' => $request['marcaVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'soat' => $request['soat']
                ]);
            }elseif (Auth::user()->tipo == 1) {
                /*DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update(['nombreContacto' => $request['nombreContacto'], 
                    'apellidosContacto' => $request['apellidosContacto'],
                    'celularContacto' => $request['celularContacto'],
                    'idTaxista' => $request['idPersona']
                ]);*/
            }            
        }else{
            return false;
        }
    }
}
