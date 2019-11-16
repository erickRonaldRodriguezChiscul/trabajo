<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegistrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function addTaxi(Request $request){
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'name'=> 'required|string',
                'email' => 'email|required|string',
                'dni'=> 'required|string',
                'fecha'=> 'required|string',
                'apellidos' => 'required|string'
            ],['email.required'=>'El campo es requerido.',
                'dni.required' => 'El campo es requerido.',
                'name.required' => 'El campo es requerido.',
                'fecha.required' => 'El campo es requerido.']);
            
            $idPersonas =DB::table('persona')->insertGetId(
                ['nombre' => $request['name'], 
                'apellidos' => $request['apellidos'],
                'email' => $request['email'],
                'dni' => $request['dni'],
                'sexo'=> $request['sexo'],
                'fechaNacimiento'=>$request['fecha']]
            );

            $idUsers=DB::table('users')->insertGetId(
                ['name' => $request['name'], 
                'email' => $request['email'],
                'idPersona'=>$idPersonas,
                'estado' => 'S',
                'tipo'=> '2',
                'password' => Hash::make($request['dni'])]
            );
            return $idUsers;
        }
    }

    //incompleto :D
    public function addContacto(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 2){
                $credenciales = $this->validate(request(),[
                    'nombreContacto'=> 'required|string',
                    'apellidosContacto' => 'required|string',
                    'celularContacto'=> 'required|string'
                ],['nombreContacto.required'=>'El campo es requerido.',
                    'apellidosContacto.required' => 'El campo es requerido.',
                    'celularContacto.required' => 'El campo es requerido.'
                ]);
                $idContacto =DB::table('contacto')->insertGetId(
                    ['idTaxista' => Auth::user()->idPersona, 
                    'apellidosContacto' =>  $request['apellidosContacto'],
                    'nombreContacto' => $request['nombreContacto'],
                    'celularContacto' => $request['celularContacto'],
                    'estado' => 'S'
                    ]
                );  
            }else{
                $credenciales = $this->validate(request(),[
                    'idPersona'=> 'required|string',
                    'nombreContacto'=> 'required|string',
                    'apellidosContacto' => 'required|string',
                    'celularContacto'=> 'required|string'
                ],['nombreContacto.required'=>'El campo es requerido.',
                    'apellidosContacto.required' => 'El campo es requerido.',
                    'celularContacto.required' => 'El campo es requerido.',
                    'idPersona.required' => 'El campo es requerido'
                ]);
                $idContacto =DB::table('contacto')->insertGetId(
                    ['idTaxista' => $request['idPersona'], 
                    'apellidosContacto' =>  $request['apellidosContacto'],
                    'nombreContacto' => $request['nombreContacto'],
                    'celularContacto' => $request['celularContacto'],
                    'estado' => 'S'
                    ]
                );  
            }
        }
    }

    public function addVehiculo(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 2){
                $credenciales = $this->validate(request(),[
                    'marcaVehiculo'=> 'required|string',
                    'yearFabricacion' => 'required|string',
                    'placaVehiculo'=> 'required|string',
                    'soat'=> 'required|string',
                    'tipoVehiculo'=> 'required|string',
                    'revisionTecnica'=> 'required|string',
                ],['marcaVehiculo.required'=>'El campo es requerido.',
                    'yearFabricacion.required' => 'El campo es requerido.',
                    'placaVehiculo.required' => 'El campo es requerido.',
                    'soat.required' => 'El campo es requerido.',
                    'tipoVehiculo.required' => 'El campo es requerido.',
                    'revisionTecnica.required' => 'El campo es requerido.'
                ]);
                $idContacto =DB::table('vehiculo')->insertGetId(
                    ['idPersona' => Auth::user()->idPersona, 
                    'marcaVehiculo' =>  $request['marcaVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'soat' => $request['soat'],
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'revisionTecnica' => $request['revisionTecnica'],
                    'estado' => 'S'
                    ]
                );  
            }else{  
            }
        }
    }
}
