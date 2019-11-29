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
            }

            if ($request->hasFile('subirBrevete')) {
                $extension2 = $request->file('subirBrevete')->extension();
                $file2 = 'brevete_'.$request['idPersona'].'.'.$extension2;
                Image::make($request->file('subirBrevete'))
                ->resize(200,200)
                ->save('imagen/'.$file2);
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
                DB::table('vehiculo')
                ->where('idVehiculo', $request['idVehiculo'])
                ->update(['revisionTecnica' => $request['revisionTecnica'], 
                    'tipoVehiculo' => $request['tipoVehiculo'],
                    'marcaVehiculo' => $request['marcaVehiculo'],
                    'yearFabricacion' => $request['yearFabricacion'],
                    'placaVehiculo' => $request['placaVehiculo'],
                    'soat' => $request['soat'],
                    'idPersona' => $request['idPersona'],
                    'estado' => $request['estado']
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
}
