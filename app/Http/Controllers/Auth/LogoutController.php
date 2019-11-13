<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }
    public function index(){
        if(Auth::check()){
            Auth::logout();
        }
        return redirect('/');
    }
}
