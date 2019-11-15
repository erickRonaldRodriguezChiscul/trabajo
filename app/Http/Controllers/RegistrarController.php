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
                    'celularContacto.required' => 'El campo es requerido.'
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
}
