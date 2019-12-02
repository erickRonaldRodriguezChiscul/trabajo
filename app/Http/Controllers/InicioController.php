<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function index(){
        $taxista = '';
        $vehiculo = '';
        $cliente = '';
        $contacto = '';
        if(Auth::user()->tipo == 1){
            $taxista = DB::table('users')->where('tipo','=','2')->count();
            $vehiculo = DB::table('vehiculo')->count();
            $cliente = DB::table('cliente')->count();
            $contacto = DB::table('contacto')->count();
        }elseif(Auth::user()->tipo == 2){
            $vehiculo = DB::table('vehiculo')->where([
                ['idPersona','=',Auth::user()->idPersona],
                ['estado','=','S'],
            ])->count(); 
            $cliente = DB::table('cliente')->join('users','cliente.idCliente','=','users.idPersona')->where([
                ['cliente.idPersona','=',Auth::user()->idPersona],
                ['users.estado','=','S'],
            ])->count();
            $contacto = DB::table('contacto')->where([
                ['idTaxista','=',Auth::user()->idPersona],
                ['estado','=','S'],
            ])->count();
        }
        return view("page.inicio",['name'=>'inicio','taxista'=>$taxista,'vehiculo'=>$vehiculo,'cliente'=>$cliente,'contacto'=>$contacto,'subName'=>'']);
    }
    public function taxista(){
        return view("taxista.taxista",['name'=>'taxista','subName'=>'']);
    }
    public function cliente(){
        return view("cliente.cliente",['name'=>'cliente','subName'=>'']);
    }

    public function vehiculo(){
        return view("vehiculo.vehiculo",['name'=>'vehiculo','subName'=>'vehiculo']);
    }
    public function contacto(){
        return view("contacto.contacto",['name'=>'contacto','subName'=>'']);
    }

    public function configuracion(){
        return view("configuracion.configuracion",['name'=>'configuracion','subName'=>'']);
    }

    public function dato(){
        return view("dato.dato",['name'=>'dato','subName'=>'']);
    }
    
    public function servicio(){
        return view("servicio.servicio",['name'=>'servicio','subName'=>'']);
    }

    public function programacion(){
        return view("programacion.programacion",['name'=>'programacion','subName'=>'']);
    }
    public function revision(){
        return view("revision.revision",['name'=>'vehiculo','subName'=>'revision']);
    }
    public function soat(){
        return view("soat.soat",['name'=>'vehiculo','subName'=>'soat']);
    }
    public function seguro(){
        return view("seguro.seguro",['name'=>'vehiculo','subName'=>'seguro']);
    }
}
