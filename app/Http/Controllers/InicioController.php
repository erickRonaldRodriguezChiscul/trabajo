<?php

namespace App\Http\Controllers;
use App\{User,Persona};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function index(){
        return view("page.inicio",['name'=>'inicio']);
    }
    public function taxista(){
        $personas = DB::table('persona')->paginate(15);
        return view("taxista.taxista",['name'=>'taxista']);
    }
    public function cliente(){
        return view("cliente.cliente",['name'=>'cliente']);
    }

    public function vehiculo(){
        return view("vehiculo.vehiculo",['name'=>'vehiculo']);
    }
    public function contacto(){
        return view("contacto.contacto",['name'=>'contacto']);
    }
}
