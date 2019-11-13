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
        $personas = DB::table('persona')->join('users',function ($join) {
            $join->on('persona.id', '=', 'users.idPersona');
        })
        ->where('persona.nombre', 'LIKE', '%'.$palabra.'%')
        ->orWhere('persona.apellidos', 'LIKE', '%'.$palabra.'%')
        ->paginate(15);
        return view("taxista.mostrar",['personas'=>$personas]);
    }
    public function registrarTaxista()
    {
        return view("taxista.registrar");
    }
}
