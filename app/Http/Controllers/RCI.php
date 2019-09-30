<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RCI extends Controller
{
    public function index()
    {
           return view('pages.reporte_cursos_impartidos');
    }
}
