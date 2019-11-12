<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User,Persona};
use Illuminate\Support\Facades\DB;

class MostrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function taxista(Request $request){
        $palabra = $request['query'];
        $page = $request['page'];
        $personas = DB::table('persona')->where('nombre', 'LIKE', '%'.$palabra.'%')->orWhere('apellidos', 'LIKE', '%'.$palabra.'%')->paginate(15);
        return view("taxista.mostrar",['personas'=>$personas]);
    }
    public function registrar()
    {
        return view("taxista.registrar");
    }
}
