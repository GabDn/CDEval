<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function cursos(){
        return view("pages.cursos");
    }

    public function instructores(){
        return view("pages.instructores");
    }
}
