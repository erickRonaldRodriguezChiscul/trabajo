<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{User,Persona};
use Illuminate\Support\Facades\DB;

class EditarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function recuperarTaxista(Request $request)
    {
        if($request->ajax()){
            $personas = DB::table('persona')->join('users',function ($join) {
                $join->on('persona.id', '=', 'users.idPersona')
                ->where('users.idPersona','=',$request['idEditar']);
            })->get();
        }
        return response()->json(['persona' => $personas]);
    }
}
