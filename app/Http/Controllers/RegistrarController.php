<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class RegistrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function addTaxi(Request $request){
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'name'=> 'required',
                'email' => 'required',
                'numeroDocumento'=> 'required',
                'fecha'=> 'required',
                'apellidos' => 'required',
                'subirFoto' =>'required',
                'nmrLicencia' => 'required',
                'fechaEmision' => 'required',
                'fechaVencimiento' => 'required',
                'subirBrevete' => 'required'
            ],['email.required'=>'El campo es requerido.',
                'numeroDocumento.required' => 'El campo es requerido.',
                'name.required' => 'El campo es requerido.',
                'apellidos.required' => 'El campo es requerido.',
                'fecha.required' => 'El campo es requerido.',
                'subirFoto.required' => 'El campo es requerido',
                'nmrLicencia.required' => 'El campo es requerido',
                'fechaEmision.required' => 'El campo es requerido',
                'fechaVencimiento.required' => 'El campo es requerido',
                'subirBrevete.required' => 'El campo es requerido'
                ]);

            $idPersonas =DB::table('persona')->insertGetId(
                ['nombre' => $request['name'], 
                'apellidos' => $request['apellidos'],
                'email' => $request['email'],
                'nmrDocumento' => $request['numeroDocumento'],
                'sexo'=> $request['sexo'],
                'fechaNacimiento'=>$request['fecha'],
                'tipoDocumento'=>$request['tipoDocumento']]
            );

            $extension = $request->file('subirFoto')->extension();
            $file = 'perfil_'.$idPersonas.'.'.$extension;
            
            Image::make($request->file('subirFoto'))
            ->save('imagen/'.$file);
            //$path = $request->subirFoto->storeAs('public',$file);

            $idUsers=DB::table('users')->insertGetId(
                ['name' => $request['name'], 
                'email' => $request['email'],
                'idPersona'=>$idPersonas,
                'estado' => 'S',
                'tipo'=> '2',
                'password' => Hash::make($request['dni']),
                'foto' => $file]
            );

            $extension2 = $request->file('subirBrevete')->extension();
            $file2 = 'brevete_'.$idPersonas.'.'.$extension2;
            //$path2 = $request->subirBrevete->storeAs('public',$file2);
            Image::make($request->file('subirBrevete'))
            ->resize(200,200)
            ->save('imagen/'.$file2);

            $idLicencia=DB::table('licencia')->insertGetId(
                ['categoria' => $request['tipoCategoria'], 
                'numeroLicencia' => $request['nmrLicencia'],
                'fechaEmision'=>$request['fechaEmision'],
                'fechaVencimiento' => $request['fechaVencimiento'],
                'imagenBrevete'=> $file2,
                'idPersona' => $idPersonas]
            );
        }
    }

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
                    'modeloVehiculo'=> 'required|string',
                    'tipoVehiculo'=> 'required|string',
                    'subirPropiedad'=> 'required|image',
                    'entidadRevision'=> 'required|string',
                    'subirRevision'=> 'required|image',
                    'fechaVencimientoRevision'=> 'required|string',
                    'observaciones'=> 'required|string',
                    'entidadSoat'=> 'required|string',
                    'fechaVencimientoSoat'=> 'required|string',
                    'subirSoat'=> 'required|image',
                    'entidadSeguro'=> 'required|string',
                    'fechaVencimientoSeguro'=> 'required|string',
                    'subirSeguro'=> 'required|image',
                ],['marcaVehiculo.required'=>'El campo es requerido.',
                    'yearFabricacion.required' => 'El campo es requerido.',
                    'placaVehiculo.required' => 'El campo es requerido.',
                    'modeloVehiculo.required' => 'El campo es requerido.',
                    'tipoVehiculo.required' => 'El campo es requerido.',
                    'subirPropiedad.required' => 'El campo es requerido.',
                    'entidadRevision.required' => 'El campo es requerido.',
                    'subirRevision.required' => 'El campo es requerido.',
                    'fechaVencimientoRevision.required' => 'El campo es requerido.',
                    'observaciones.required' => 'El campo es requerido.',
                    'entidadSoat.required' => 'El campo es requerido.',
                    'fechaVencimientoSoat.required' => 'El campo es requerido.',
                    'subirSoat.required' => 'El campo es requerido.',
                    'entidadSeguro.required' => 'El campo es requerido.',
                    'fechaVencimientoSeguro.required' => 'El campo es requerido.',
                    'subirSeguro.required' => 'El campo es requerido.',
                ]);

                $idVehiculo  =DB::table('vehiculo')->insertGetId(
                    [
                        'idPersona' => $request['idPersona'], 
                        'marcaVehiculo' =>  $request['marcaVehiculo'],
                        'placaVehiculo' => $request['placaVehiculo'],
                        'tipoVehiculo' => $request['tipoVehiculo'],
                        'yearFabricacion' => $request['yearFabricacion'],
                        'modeloVehiculo' => $request['modeloVehiculo'],
                        'estado' => 'S',
                        'tarjetaPropiedad' => $request['tarjetaPropiedad'],
                    ]
                ); 
            }elseif (Auth::user()->tipo == 1) {  
                $credenciales = $this->validate(request(),[
                    'idPersona'=> 'required|string',
                    'marcaVehiculo'=> 'required|string',
                    'yearFabricacion' => 'required|string',
                    'placaVehiculo'=> 'required|string',
                    'modeloVehiculo'=> 'required|string',
                    'tipoVehiculo'=> 'required|string',
                    'subirPropiedad'=> 'required|image',
                    'entidadRevision'=> 'required|string',
                    'subirRevision'=> 'required|image',
                    'fechaVencimientoRevision'=> 'required|string',
                    'observaciones'=> 'required|string',
                    'entidadSoat'=> 'required|string',
                    'fechaVencimientoSoat'=> 'required|string',
                    'subirSoat'=> 'required|image',
                    'entidadSeguro'=> 'required|string',
                    'fechaVencimientoSeguro'=> 'required|string',
                    'subirSeguro'=> 'required|image',
                ],['marcaVehiculo.required'=>'El campo es requerido.',
                    'yearFabricacion.required' => 'El campo es requerido.',
                    'placaVehiculo.required' => 'El campo es requerido.',
                    'modeloVehiculo.required' => 'El campo es requerido.',
                    'tipoVehiculo.required' => 'El campo es requerido.',
                    'subirPropiedad.required' => 'El campo es requerido.',
                    'entidadRevision.required' => 'El campo es requerido.',
                    'subirRevision.required' => 'El campo es requerido.',
                    'fechaVencimientoRevision.required' => 'El campo es requerido.',
                    'observaciones.required' => 'El campo es requerido.',
                    'entidadSoat.required' => 'El campo es requerido.',
                    'fechaVencimientoSoat.required' => 'El campo es requerido.',
                    'subirSoat.required' => 'El campo es requerido.',
                    'entidadSeguro.required' => 'El campo es requerido.',
                    'fechaVencimientoSeguro.required' => 'El campo es requerido.',
                    'subirSeguro.required' => 'El campo es requerido.',
                    'idPersona.required' => 'El campo es requerido'
                ]);
                $idVehiculo =DB::table('vehiculo')->insertGetId(
                    ['idPersona' => $request['idPersona'], 
                    'marcaVehiculo' =>  $request['marcaVehiculo'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'modeloVehiculo' => $request['modeloVehiculo'],
                    'estado' => 'S',
                    'tarjetaPropiedad' => $request['tarjetaPropiedad'],
                    ]
                ); 
            }

            $extension = $request->file('subirRevision')->extension();
            $file = 'revision_'.$idVehiculo.'.'.$extension;
            Image::make($request->file('subirRevision'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$file);

            $idRevisionTecnica = DB::table('revisionTecnica')->insertGetId(
                [
                    'entidadRevision' => $request['entidadRevision'],
                    'fechaVencimientoRevision' => $request['fechaVencimientoRevision'],
                    'observacionesRevision' => $request['observaciones'],
                    'fotoRevision' =>  $file,
                    'idVehiculo' => $idVehiculo
                ]
            );

            $extensionSeguro = $request->file('subirSeguro')->extension();
            $fileSeguro = 'seguro_'.$idVehiculo.'.'.$extensionSeguro;
            Image::make($request->file('subirSeguro'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$fileSeguro);

            $idseguroRiesgo = DB::table('seguroRiesgo')->insertGetId(
                [
                    'entidadSeguro' => $request['entidadSeguro'],
                    'fechaVencimientoSeguro' => $request['fechaVencimientoSeguro'],
                    'fotoSeguro' =>  $fileSeguro,
                    'idVehiculo' => $idVehiculo
                ]
            );

            $extensionSoat = $request->file('subirSoat')->extension();
            $fileSoat = 'soat_'.$idVehiculo.'.'.$extensionSoat;
            Image::make($request->file('subirSoat'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$fileSoat);

            $idsoat = DB::table('soat')->insertGetId(
                [
                    'entidadSoat' => $request['entidadSoat'],
                    'fechaVencimientoSoat' => $request['fechaVencimientoSoat'],
                    'fotoSoat' =>  $fileSoat,
                    'idVehiculo' => $idVehiculo
                ]
            );

            $extensionTarjeta = $request->file('subirPropiedad')->extension();
            $fileTarjeta = 'propiedad_'.$idVehiculo.'.'.$extensionTarjeta;
            Image::make($request->file('subirPropiedad'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$fileTarjeta);

            DB::table('vehiculo')->where('idVehiculo', $idVehiculo)
            ->update([
                'revisionActual' => $idRevisionTecnica, 
                'seguroActual' => $idseguroRiesgo,
                'soatActual'=> $idsoat,
                'tarjetaPropiedad' => $fileTarjeta
            ]);
        }
    }

    public function addCliente(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 2){
                $credenciales = $this->validate(request(),[
                    'nombreCliente'=> 'required|string',
                    'dniCliente' => 'required|string',
                    'emailCliente'=> 'required|string',
                    'apellidosCliente'=> 'required|string',
                    'celularCliente'=> 'required|string',
                ],['nombreCliente.required'=>'El campo es requerido.',
                    'dniCliente.required' => 'El campo es requerido.',
                    'emailCliente.required' => 'El campo es requerido.',
                    'apellidosCliente.required' => 'El campo es requerido.',
                    'celularCliente.required' => 'El campo es requerido.',
                ]);

                $idPersona = DB::table('persona')->insertGetId([
                    'nombre' => $request['nombreCliente'],
                    'apellidos' => $request['apellidosCliente'],
                    'email' => $request['emailCliente'],
                    'dni' => $request['dniCliente'],
                    'sexo' => $request['sexoCliente']
                ]);

                $idUsuario = DB::table('users')->insertGetId([
                    'name' => $request['nombreCliente'],
                    'email' =>$request['emailCliente'],
                    'password'=> Hash::make($request['dniCliente']),
                    'estado' => 'S',
                    'tipo' =>'3',
                    'idPersona' => $idPersona
                ]);

                DB::table('cliente')->insert([
                    'idCliente' => $idPersona,
                    'idPersona' => Auth::user()->idPersona, 
                    'celularCliente' => $request['celularCliente']
                ]);  
            }elseif (Auth::user()->tipo == 1) {  
                $credenciales = $this->validate(request(),[
                    'idPersona'=> 'required|string',
                    'nombreCliente'=> 'required|string',
                    'dniCliente' => 'required|string',
                    'emailCliente'=> 'required|string',
                    'apellidosCliente'=> 'required|string',
                    'celularCliente'=> 'required|string'
                ],['nombreCliente.required'=>'El campo es requerido.',
                    'dniCliente.required' => 'El campo es requerido.',
                    'emailCliente.required' => 'El campo es requerido.',
                    'apellidosCliente.required' => 'El campo es requerido.',
                    'celularCliente.required' => 'El campo es requerido.',
                    'idPersona.required' => 'El campo es requerido'
                ]);

                $idPersona = DB::table('persona')->insertGetId([
                    'nombre' => $request['nombreCliente'],
                    'apellidos' => $request['apellidosCliente'],
                    'email' => $request['emailCliente'],
                    'dni' => $request['dniCliente'],
                    'sexo' => $request['sexoCliente']
                ]);

                $idUsuario = DB::table('users')->insertGetId([
                    'name' => $request['nombreCliente'],
                    'email' =>$request['emailCliente'],
                    'password'=> Hash::make($request['dniCliente']),
                    'estado' => 'S',
                    'tipo' =>'3',
                    'idPersona' => $idPersona
                ]);

                DB::table('cliente')->insert([
                    'idCliente' => $idPersona,
                    'idPersona' => $request['idPersona'], 
                    'celularCliente' => $request['celularCliente']
                ]);
            }
        }
    }

    public function addServicio(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 1){
                $credenciales = $this->validate(request(),[
                    'nombreServicio'=> 'required|string',
                    'importeServicio' => 'required|string'
                ],['nombreServicio.required'=>'El campo es requerido.',
                    'importeServicio.required' => 'El campo es requerido.',
                ]);

                $idPersona = DB::table('servicio')->insertGetId([
                    'nombreServicio' => $request['nombreServicio'],
                    'importe' => $request['importeServicio'],
                    'estado' => 'S'
                ]);
            }
        }
    }

    public function addProgramacion(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 1){
                $credenciales = $this->validate(request(),[
                    'servicio'=> 'required|string',
                    'multiPersona' => 'required'
                ],['servicio.required'=>'El campo es requerido.',
                    'multiPersona.required' => 'El campo es requerido.',
                ]);

                $idProgramacion = DB::table('programacion')->insertGetId([
                    'fechaInicio' => $request['inicio'],
                    'fechaFinal' => $request['fin'],
                    'idServicio' => $request['servicio'],
                    'estado' => 'S'
                ]);

                if($request['multiPersona'][0] == -1){
                    $personas = DB::table('persona')->join('users',function ($join) {
                        $join->on('persona.id', '=', 'users.idPersona')
                        ->where('users.tipo','=',2)
                        ->where('users.estado','=','S');
                    })
                    ->select('persona.id')
                    ->get();
                    foreach ($personas as $key) {
                        $idPersona = DB::table('progPerso')->insertGetId([
                            'idProgramacion' => $idProgramacion,
                            'idPersona' => $key->id
                        ]);
                    }
                }else{
                    foreach ($request['multiPersona'] as $key) {
                        $idPersona = DB::table('progPerso')->insertGetId([
                            'idProgramacion' => $idProgramacion,
                            'idPersona' => $key
                        ]);
                    }
                }
            }
        }
    }

    public function addDato(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 2){
                $credenciales = $this->validate(request(),[
                    'descripcion'=> 'required|string',
                    'tipo' => 'required|string'
                ],['descripcion.required'=>'El campo es requerido.',
                    'tipo.required' => 'El campo es requerido.',
                ]);
                $idDato =DB::table('dato')->insertGetId(
                    ['idPersona' => Auth::user()->idPersona, 
                    'descripcion' =>  $request['descripcion'],
                    'tipo' => $request['tipo'],
                    'estado' => 'S'
                    ]
                );  
            }else{
                $credenciales = $this->validate(request(),[
                    'idPersona'=> 'required|string',
                    'descripcion'=> 'required|string',
                    'tipo' => 'required|string',
                ],['idPersona.required'=>'El campo es requerido.',
                    'descripcion.required'=>'El campo es requerido.',
                    'tipo.required' => 'El campo es requerido.'
                ]);
                $idDato =DB::table('dato')->insertGetId(
                    ['idPersona' => $request['idPersona'], 
                    'descripcion' =>  $request['descripcion'],
                    'tipo' => $request['tipo'],
                    'estado' => 'S'
                    ]
                );  
            }
        }
    }

    public function addRevision(Request $request){
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadRevision'=> 'required|string',
                'fechaVencimientoRevision' => 'required|string',
                'observaciones' => 'required|string',
                'subirRevision' => 'required|image',
            ],['entidadRevision.required'=>'El campo es requerido.',
                'fechaVencimientoRevision.required' => 'El campo es requerido.',
                'observaciones.required' => 'El campo es requerido.',
                'subirRevision.required' => 'El campo es requerido.',
                'subirRevision.image' => 'Debe subir una imagen'
            ]);

            $extension = $request->file('subirRevision')->extension();
            $file = 'revision_'. $request['idVehiculo'].'.'.$extension;
            Image::make($request->file('subirRevision'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$file);

            $idRevicion =DB::table('revisiontecnica')->insertGetId(
                ['entidadRevision' => $request['entidadRevision'], 
                'fechaVencimientoRevision' =>  $request['fechaVencimientoRevision'],
                'observacionesRevision' => $request['observaciones'],
                'fotoRevision' => $file,
                'idVehiculo' => $request['idVehiculo']
                ]
            );  
            DB::table('vehiculo')
            ->where('idVehiculo', $request['idVehiculo'])
            ->update([
                'revisionActual' => $idRevicion
            ]);
        }
    }

    public function addSoat(Request $request){
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadSoat'=> 'required|string',
                'fechaVencimientoSoat' => 'required|string',
                'subirSoat' => 'required|image',
            ],['entidadSoat.required'=>'El campo es requerido.',
                'fechaVencimientoSoat.required' => 'El campo es requerido.',
                'subirSoat.required' => 'El campo es requerido.',
                'subirSoat.image' => 'Debe subir una imagen'
            ]);

            $extension = $request->file('subirSoat')->extension();
            $file = 'soat_'. $request['idVehiculo'].'.'.$extension;
            Image::make($request->file('subirSoat'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$file);

            $idRevicion =DB::table('soat')->insertGetId(
                [
                'entidadSoat' => $request['entidadSoat'], 
                'fechaVencimientoSoat' =>  $request['fechaVencimientoSoat'],
                'fotoSoat' => $file,
                'idVehiculo' => $request['idVehiculo']
                ]
            );  
            DB::table('vehiculo')
            ->where('idVehiculo', $request['idVehiculo'])
            ->update([
                'soatActual' => $idRevicion
            ]);
        }
    }

    public function addSeguro(Request $request){
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadSeguro'=> 'required|string',
                'fechaVencimientoSeguro' => 'required|string',
                'subirSeguro' => 'required|image',
            ],['entidadSeguro.required'=>'El campo es requerido.',
                'fechaVencimientoSeguro.required' => 'El campo es requerido.',
                'subirSeguro.required' => 'El campo es requerido.',
                'subirSeguro.image' => 'Debe subir una imagen'
            ]);

            $extension = $request->file('subirSeguro')->extension();
            $file = 'seguro_'. $request['idVehiculo'].'.'.$extension;
            Image::make($request->file('subirSeguro'))
            ->resize(200,200)
            ->save('imagen/vehiculos/'.$file);

            $idRevicion =DB::table('seguroriesgo')->insertGetId(
                [
                'entidadSeguro' => $request['entidadSeguro'], 
                'fechaVencimientoSeguro' =>  $request['fechaVencimientoSeguro'],
                'fotoSeguro' => $file,
                'idVehiculo' => $request['idVehiculo']
                ]
            );  
            DB::table('vehiculo')
            ->where('idVehiculo', $request['idVehiculo'])
            ->update([
                'seguroActual' => $idRevicion
            ]);
        }
    }
    
    public function addTarifa(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 1){
                $credenciales = $this->validate(request(),[
                    'nombreTarifa'=> 'required|string',
                    'porcentajeTarifa'=> 'required',
                ],[
                    'nombreTarifa.required'=>'El campo es requerido.',
                    'porcentajeTarifa.required' => 'El campo es requerido.',
                ]);
                $idTarifa =DB::table('tarifa')->insertGetId(
                    ['tipoTarifa' => $request['nombreTarifa'], 
                    'porcentaje' =>  $request['porcentajeTarifa'],
                    ]
                );  
            }
        }
    }
    public function addCarrera(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 3){
                $credenciales = $this->validate(request(),[
                    'direccionInicio'=> 'required|string',
                    'direccionLlegada' => 'required|string'
                ],[
                    'direccionInicio.required'=>'El campo es requerido.',
                    'direccionLlegada.required' => 'El campo es requerido.',
                ]);

                $idProgramacion = DB::table('carrera')->insertGetId([
                    'inicioCarrera' => $request['direccionInicio'],
                    'finalCarrera' => $request['direccionLlegada'],
                    'estadoCarrera' => 'S',
                    'idCliente' => Auth::user()->idPersona,
                    'idPersona' => $request['idPersona'],
                    'fechaCarrera' => $request['fechaCarrera']
                ]);
            }
        }
    }
}
