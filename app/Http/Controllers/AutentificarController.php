<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use App\Http\Controllers\Controller;

class AutentificarController extends Controller{
# 2143231
# RAGJ720101T72

     public function index(Request $request){
        $infoCursos=array();
        if($request->rfc == "VAMV720101HZA"){
            if($request->numTrabajador == "2143250"){
                $profesor=Profesor::where('rfc', 'VAMV720101HZA')->where('numero_trabajador','2143250')->get();
                $cursos=Curso::all();
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->id);
                   
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                }
                return $profesor;
                return view("pages.superadmin")
                ->with("profesor",$profesor)
                ->with('infoCursos',$infoCursos);
            }else{
                return "Contraseña de administrador equivocada";
            }

        }

        
        $profesores = Profesor::all();
        foreach($profesores as $profesor){
            if ($profesor->rfc == $request->rfc) {
                //El profesor está en la BD
                if ($profesor->numero_trabajador == $request->numTrabajador) {
                    //El profesor está en la BD y las credenciales son correctas
                    $participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                    foreach($participantesCurso as $participanteCurso){
                        $curso = Curso::find($participanteCurso->id);
                        $catalogoCursos = CatalogoCurso::find($curso->id);
                       
                        $tupla = array();
                            array_push($tupla,$curso);
                            array_push($tupla,$catalogoCursos);
                        array_push($infoCursos, $tupla);
                    }
                    return view("pages.admin")
                    ->with("profesor",$profesor)
                    ->with('infoCursos',$infoCursos);
                            
                } else {
                    return "El profesor está en la bd pero el número de trabajador está mal";
                }
            }else{
                return "El profesor no está en la BD";
            }
            
        }
        return view('pages.xsesion_seminario');
     }

}
