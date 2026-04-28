<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
{
    // Renderiza a view userdex.blade.php
    public function index()
    {
        return view('usuario');
    }
}