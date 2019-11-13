<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EliminarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }

    public function eliminarTaxista(Request $request)
    {
        if ($request->ajax()) {
            DB::table('users')
            ->where('id', $request['id'])
            ->update(['estado' => 'N']);
            return response()->json([
                'estado' => 'ok'
            ]);
        }else{
            return response()->json([
                'estado' => 'error'
            ]);
        } 
    }
}
