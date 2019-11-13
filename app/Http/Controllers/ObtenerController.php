<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ObtenerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auto');
    }
}
