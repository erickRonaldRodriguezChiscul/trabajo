<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
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
                'email' => 'email|required|string',
                'numeroDocumento'=> 'required|string',
                'fecha'=> 'required|string',
                'apellidos' => 'required|string',
                'nmrLicencia' => 'required|string',
                'fechaEmision' => 'required|string',
                'fechaVencimiento' => 'required|string'
            ],['email.required'=>'El campo es requerido.',
                'numeroDocumento.required' => 'El campo es requerido.',
                'name.required' => 'El campo es requerido.',
                'fecha.required' => 'El campo es requerido.',
                'nrmLicencia.required' => 'El campo es requerido',
                'fechaEmision.required' => 'El campo es requerido',
                'fechaVencimiento.required' => 'El campo es requerido'
                ]);
                
            if ($request->hasFile('subirFoto')) {
                $extension = $request->file('subirFoto')->extension();
                $file = 'perfil_'.$request['idPersona'].'.'.$extension;
                Image::make($request->file('subirFoto'))
                ->resize(200,200)
                ->save('imagen/'.$file);

                DB::table('users')
                ->where('id', $request['id'])
                ->update([
                    'foto' => $file
                ]);
            }

            if ($request->hasFile('subirBrevete')) {
                $extension2 = $request->file('subirBrevete')->extension();
                $file2 = 'brevete_'.$request['idPersona'].'.'.$extension2;
                Image::make($request->file('subirBrevete'))
                ->resize(200,200)
                ->save('imagen/'.$file2);

                DB::table('licencia')
                ->where('idPersona', $request['idPersona'])
                ->update([
                    'imagenBrevete'=> $file2,
                ]);
            }

            DB::table('licencia')->where('idPersona', $request['idPersona'])
            ->update([
                    'categoria' => $request['tipoCategoria'], 
                    'numeroLicencia' => $request['nmrLicencia'],
                    'fechaEmision'=>$request['fechaEmision'],
                    'fechaVencimiento' => $request['fechaVencimiento']
            ]);

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
                'nmrDocumento' => $request['numeroDocumento'],
                'sexo'=> $request['sexo'],
                'fechaNacimiento'=>$request['fecha'],
                'tipoDocumento'=>$request['tipoDocumento']
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
                    'idTaxista' => $request['idPersona'],
                    'estado' => $request['estado']
                ]);
            }            
        }else{
            return false;
        }
    }

    public function editarVehiculo(Request $request){
        $credenciales = $this->validate(request(),[
            'tipoVehiculo'=> 'required|string',
            'marcaVehiculo'=> 'required|string',
            'yearFabricacion'=> 'required|string',
            'placaVehiculo'=> 'required|string',
            'modeloVehiculo' => 'required|string'
        ],['revisionTecnica.required'=>'El campo es requerido.',
            'tipoVehiculo.required' => 'El campo es requerido.',
            'marcaVehiculo.required' => 'El campo es requerido.',
            'yearFabricacion.required' => 'El campo es requerido.',
            'placaVehiculo.required' => 'El campo es requerido.',
            'modeloVehiculo.required' => 'El campo es requerido.'
        ]);
        if ($request->ajax()) {
            if(Auth::user()->tipo == 2){
                DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update([
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'marcaVehiculo' => $request['marcaVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'modeloVehiculo' => $request['modeloVehiculo']
                ]);
            }elseif (Auth::user()->tipo == 1) {
                DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update([
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'marcaVehiculo' => $request['marcaVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'modeloVehiculo' => $request['modeloVehiculo'],
                    'idPersona' => $request['idPersona'],
                    'estado' => $request['estado']
                ]);
            }   
            if ($request->hasFile('subirFoto')) {
                $extension = $request->file('subirFoto')->extension();
                $file = 'propiedad_'.$request['idVehiculo'].'.'.$extension;
                Image::make($request->file('subirFoto'))
                ->resize(200,200)
                ->save('imagen/vehiculos/'.$file);
                DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update([
                    'tarjetaPropiedad' => $file
                ]);
            }           
        }else{
            return false;
        }
    }

    public function editarCliente(Request $request){
        $credenciales = $this->validate(request(),[
            'celularCliente'=> 'required|string',
            'apellidosCliente'=> 'required|string',
            'emailCliente'=> 'required|string',
            'dniCliente'=> 'required|string',
            'nombreCliente'=> 'required|string'
        ],['celularCliente.required'=>'El campo es requerido.',
            'apellidosCliente.required' => 'El campo es requerido.',
            'emailCliente.required' => 'El campo es requerido.',
            'dniCliente.required' => 'El campo es requerido.',
            'nombreCliente.required' => 'El campo es requerido.'
        ]);
        if ($request->ajax()) {
            if(Auth::user()->tipo == 2){
                DB::table('users')
                ->where('idPersona', $request['idCliente'])
                ->update(['name' => $request['nombreCliente'], 
                    'email' => $request['emailCliente']
                ]);

                DB::table('persona')
                ->where('id', $request['idCliente'])
                ->update(['nombre' => $request['nombreCliente'], 
                    'dni' => $request['dniCliente'],
                    'email' => $request['emailCliente'],
                    'apellidos' => $request['apellidosCliente'],
                    'sexo' => $request['sexoCliente']
                ]);

                DB::table('cliente')
                ->where('idCliente', $request['idCliente'])
                ->update([
                    'celularCliente' => $request['celularCliente']
                ]);
            }elseif (Auth::user()->tipo == 1) {
                if($request['clave'] == ''){
                    DB::table('users')
                    ->where('idPersona', $request['idCliente'])
                    ->update(['name' => $request['nombreCliente'], 
                        'email' => $request['emailCliente'],
                        'estado' => $request['estado']
                    ]);
                }else{
                    DB::table('users')
                    ->where('idPersona', $request['idCliente'])
                    ->update(['name' => $request['nombreCliente'], 
                        'email' => $request['emailCliente'],
                        'estado' => $request['estado'],
                        'password' => Hash::make($request['clave']),
                    ]);
                }
                DB::table('persona')
                ->where('id', $request['idCliente'])
                ->update(['nombre' => $request['nombreCliente'], 
                    'dni' => $request['dniCliente'],
                    'email' => $request['emailCliente'],
                    'apellidos' => $request['apellidosCliente'],
                    'sexo' => $request['sexoCliente']
                ]);

                DB::table('cliente')
                ->where('idCliente', $request['idCliente'])
                ->update([
                    'celularCliente' => $request['celularCliente'],
                    'idPersona' => $request['idPersona']
                ]);
            }            
        }else{
            return false;
        }
    }

    public function editarConfiguracion(Request $request){
        if (Hash::check($request['actual'],Auth::user()->password)) {
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update([
                    'password' => Hash::make($request['nuevo'])
                ]);
            return  response()->json([
                'estado' => 'ok'
            ]);
        }else{
            return  response()->json([
                'estado' => 'error'
            ]);
        }
    }

    public function editarServicio(Request $request){
        if ($request->ajax()) {
            $credenciales = $this->validate(request(),[
                'nombreServicio'=> 'required|string',
                'importeServicio'=> 'required|string'
            ],['nombreServicio.required'=>'El campo es requerido.',
                'importarServicio.required' => 'El campo es requerido.'
            ]);
            if (Auth::user()->tipo == 1) {
                DB::table('servicio')
                ->where('idServicio', $request['idServicio'])
                ->update([
                    'nombreServicio' => $request['nombreServicio'], 
                    'importe' => $request['importeServicio'],
                    'estado' => $request['estado']
                ]);
            }            
        }else{
            return false;
        }
    }

    public function editarRevision(Request $request)
    {
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadRevision'=> 'required|string',
                'fechaVencimientoRevision' => 'required|string',
                'observaciones' => 'required|string',
            ],['entidadRevision.required'=>'El campo es requerido.',
                'fechaVencimientoRevision.required' => 'El campo es requerido.',
                'observaciones.required' => 'El campo es requerido.',
            ]);

            if($request->hasFile('subirRevision')){
                $extension = $request->file('subirRevision')->extension();
                $file = 'revision_'. $request['idVehiculo'].'.'.$extension;
                Image::make($request->file('subirRevision'))
                ->resize(200,200)
                ->save('imagen/vehiculos/'.$file);
    
                DB::table('revisiontecnica')
                ->where('idRevision', $request['idRevision'])
                ->update([
                    'fotoRevision' => $file
                ]);
            }
            
            DB::table('revisiontecnica')
            ->where('idRevision', $request['idRevision'])
            ->update([
                'entidadRevision' => $request['entidadRevision'], 
                'fechaVencimientoRevision' =>  $request['fechaVencimientoRevision'],
                'observacionesRevision' => $request['observaciones']
            ]);
        }
    }
    public function editarSoat(Request $request)
    {
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadSoat'=> 'required|string',
                'fechaVencimientoSoat' => 'required|string',
            ],['entidadSoat.required'=>'El campo es requerido.',
                'fechaVencimientoSoat.required' => 'El campo es requerido.',
            ]);

            if($request->hasFile('subirSoat')){
                $extension = $request->file('subirSoat')->extension();
                $file = 'soat_'. $request['idVehiculo'].'.'.$extension;
                Image::make($request->file('subirSoat'))
                ->resize(200,200)
                ->save('imagen/vehiculos/'.$file);
    
                DB::table('soat')
                ->where('idSoat', $request['idSoat'])
                ->update([
                    'fotoSoat' => $file
                ]);
            }
            
            DB::table('soat')
            ->where('idSoat', $request['idSoat'])
            ->update([
                'entidadSoat' => $request['entidadSoat'], 
                'fechaVencimientoSoat' =>  $request['fechaVencimientoSoat'],
            ]);
        }
    }

    public function editarSeguro(Request $request)
    {
        if($request->ajax()){
            $credenciales = $this->validate(request(),[
                'entidadSeguro'=> 'required|string',
                'fechaVencimientoSeguro' => 'required|string',
            ],['entidadSeguro.required'=>'El campo es requerido.',
                'fechaVencimientoSeguro.required' => 'El campo es requerido.',
            ]);

            if($request->hasFile('subirSeguro')){
                $extension = $request->file('subirSeguro')->extension();
                $file = 'seguro_'. $request['idVehiculo'].'.'.$extension;
                Image::make($request->file('subirSeguro'))
                ->resize(200,200)
                ->save('imagen/vehiculos/'.$file);
    
                DB::table('seguroriesgo')
                ->where('idSeguro', $request['idSeguro'])
                ->update([
                    'fotoSeguro' => $file
                ]);
            }
            
            DB::table('seguroriesgo')
            ->where('idSeguro', $request['idSeguro'])
            ->update([
                'entidadSeguro' => $request['entidadSeguro'], 
                'fechaVencimientoSeguro' =>  $request['fechaVencimientoSeguro'],
            ]);
        }
    }
    public function editarTarifa(Request $request){
        if ($request->ajax()) {
            $credenciales = $this->validate(request(),[
                'nombreTarifa'=> 'required|string',
                'porcentajeTarifa'=> 'required',
            ],['nombreTarifa.required'=>'El campo es requerido.',
                'porcentajeTarifa.required' => 'El campo es requerido.',
            ]);
            if (Auth::user()->tipo == 1) {
                DB::table('tarifa')
                ->where('idTarifa', $request['idTarifa'])
                ->update(['tipoTarifa' => $request['nombreTarifa'], 
                    'porcentaje' => $request['porcentajeTarifa'],
                    'estado' => $request['estado']
                ]);
            }            
        }else{
            return false;
        }
    }

    public function editarProgramacion(Request $request){
        if($request->ajax()){
            if(Auth::user()->tipo == 1){
                $credenciales = $this->validate(request(),[
                    'servicio'=> 'required|string',
                    'multiPersona' => 'required'
                ],['servicio.required'=>'El campo es requerido.',
                    'multiPersona.required' => 'El campo es requerido.',
                ]);

                $idProgramacion = DB::table('programacion')
                ->where("idProgramacion",$request['idProgramacion'])
                ->update([
                    'fechaInicio' => $request['inicio'],
                    'fechaFinal' => $request['fin'],
                    'idServicio' => $request['servicio'],
                    'estado' => 'S'
                ]);

                DB::table('progperso')->where('IdProgramacion', '=', $request['idProgramacion'])->delete();

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
                            'idProgramacion' => $request['idProgramacion'],
                            'idPersona' => $key->id
                        ]);
                    }
                }else{
                    foreach ($request['multiPersona'] as $key) {
                        $idPersona = DB::table('progPerso')->insertGetId([
                            'idProgramacion' => $request['idProgramacion'],
                            'idPersona' => $key
                        ]);
                    }
                }
            }
        }
    }
}
