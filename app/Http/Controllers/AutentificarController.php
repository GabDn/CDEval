<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use App\Coordinacion;
use App\Http\Controllers\Controller;

class AutentificarController extends Controller{
# 2143246
# DOMJ7201011Q9
# 2143231
# RAGJ720101T72

#JUFM720101M74 
#12143235

     public function index(Request $request){
        //return view("pages.superadmin");
        $infoCursos=array(); 
        $profesores = Profesor::all();
        $coordinaciones = Coordinacion::all();
      
        //Usuario general
        if ('admin' == $request->rfc && '1q2w3e4r' == $request->numTrabajador) {
            //return redirect()->route("superadmin",[$coordinaciones]);
            return view('pages.superadmin')
                ->with("coordinaciones",$coordinaciones); //Route -> coordinador
        }
        //Coordinadores de área
        $coordinadores = Coordinacion::all();
        $correcto = False;
        foreach($coordinadores as $coordinador){
            if ($coordinador->usuario == $request->rfc){
                $correcto = True;
                break;
            }
        }
        if($correcto){
            if($coordinador->password == $request->numTrabajador){
                //El coordinador está en la BD y las credenciales son correctas
                $encargado = Coordinacion::findorFail($coordinador->id);
                
                return view("pages.superadminCoordinadores")
                        ->with("encargado",$encargado);
            }else return back()->with('error', 'Contraseña incorrecta');
        }
        
        //Comprobando usuarios normales 
		$correcto_usuario = False;
        foreach($profesores as $profesor){
			if ($profesor->rfc == $request->rfc) {
				$correcto_usuario = True;
				break;
			}
		}
        if ($correcto_usuario) {
            if ($profesor->numero_trabajador == $request->numTrabajador) {
                //El profesor está en la BD y las credenciales son correctas
				$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                //return $participantesCurso;
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    //return $curso;
                    array_push($cursos,$curso); 
                }
                //$cursos=Curso::all();
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                    //return $catalogoCursos;
                    //return $infoCursos;
                }
                //return $infoCursos;
                return view("pages.admin")
					->with("profesor",$profesor)
					->with('infoCursos',$infoCursos);
            }else return back()->with('error', 'Número de trabajador inválido'); 
        }else return back()->with('error', 'RFC o usuario inválido');
        return back()->with('error','Datos inválidos');
    }
}