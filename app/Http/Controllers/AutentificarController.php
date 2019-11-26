<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use App\Http\Controllers\Controller;

class AutentificarController extends Controller{
# 2143246
# DOMJ7201011Q9
     public function index(Request $request){
        $infoCursos=array(); 
        $profesores = Profesor::all();
        foreach($profesores as $profesor){
            if ($profesor->rfc == $request->rfc) {
                //El profesor está en la BD
                if ($profesor->numero_trabajador == $request->numTrabajador) {
                    //El profesor está en la BD y las credenciales son correctas
                    $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                    $cursos=Curso::all();
                    foreach($cursos as $curso){
                       $catalogoCursos = CatalogoCurso::find($curso->id);
                       $tupla = array();
                        array_push($tupla,$curso);
                        array_push($tupla,$catalogoCursos);
                        array_push($infoCursos, $tupla);
                    }
                    return view("pages.admin")
                    ->with("profesor",$profesor)
                    ->with('infoCursos',$infoCursos);
                } 
            }
        }
        return back()->with('error','Datos invalidos');   
    }
}