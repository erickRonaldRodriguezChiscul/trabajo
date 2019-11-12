<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['only'=>'validacion']);
        
    }
    public function login(){
            $credenciales = $this->validate(request(),[
                'email' => 'email|required|string',
                'password'=> 'required|string'
            ],['email.required'=>'El campo es requerido.',
                'password.required' => 'El campo es requerido']);
            if(Auth::attempt($credenciales)){
                return redirect()->route('inicio');
            }else{
                return back()->withErrors(['email'=>'Las credenciales no coinciden con nuestros registros.'])
                            ->withInput(request(['email']));;
            }
    }
    public function validacion(){
        return view('auth.login');
    }
}
