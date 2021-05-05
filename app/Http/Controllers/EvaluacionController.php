<?php

namespace App\Http\Controllers;
use App\Profesor;
use App\Curso;
use App\CatalogoCurso;
use App\ParticipantesCurso;
use App\EvaluacionXCurso;
use DB;    
use App\ProfesoresCurso;
use App\EvaluacionFinalCurso;
use App\EvaluacionFinalSeminario;
use App\EvaluacionXSeminario;
use App\Coordinacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use PDF;
use View;
use Exception;
use Illuminate\Support\Facades\Session;

ini_set('max_execution_time', '500');

/**
 * Clase encargada del manejo de las evaluaciones de los cursos (redireccionamiento y almacenamiento de datos)
 * @author UNICA FI UNAM
 */
class EvaluacionController extends Controller{

	/**
	 * Funcion que redirecciona a pages.evaluacionIndex con los datos necesarios del curso seleccionado
	 * @param $profesor_id: id del profesor que evalua, $curso_id: id del curso a evaluar, $catalogoCurso_id: id del catalogo del curso a evaluar
	 * @return vista pages.evaluacionIndex
	 */
	public function index($profesor_id, $curso_id, $catalogoCurso_id){
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($curso->catalogo_id);
		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
		$participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();

		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    array_push($cursos,$curso); 
                }
                //$cursos=Curso::all();
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                }

		$date = date("Y-m-j");
		
		$curso = Curso::find($curso_id);

		//Se busca mandar a pages.evaluacionIndex las encuestas realizadas por el usuario para manejar los botones
		//Se busca evitar que el usuario realice una evaluación por segunda vez
		$evaluacion_x_curso = 0;
		$evaluacion_final_curso = 0;

		if(strcmp($catalogoCurso->tipo,"S")==0){
			$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();
		}else{
			$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();
		}

		if(strcmp($catalogoCurso->tipo,"S") == 0){
			$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
				->select('_evaluacion_final_seminario.participante_curso_id')
				->where([['participante_curso_id',$participante[0]->id],['curso_id',$curso_id]])
				->get();
		}
		else{
			$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();
		}

		//Retornamos la vista pages.evaluacionIndex con todos los datos necesarios para su funcionamiento
		return view("pages.evaluacionIndex")
			->with("profesor",$profesor)
			->with("curso",$curso)
			->with('catalogoCurso',$catalogoCurso)
			->with('infoCursos',$infoCursos)
			->with('count',$count)
			->with('evaluaciones',$evaluacion_x_curso)
			->with('final',$evaluacion_final_curso)
			->with('curso_id',$curso_id);
	  
	}
		
	/**
	 * Funcion que retorna la ruta a admin.blade.php
	 * @param $profesor_id: id del profesor que tiene los derechos de super usuario
	 */
	public function admin($profesor_id){
		$infoCursos=array(); 
        $profesor = Profesor::find($profesor_id);
        if ('admin' == $profesor->rfc && '1q2w3e4r' == $profesor->numTrabajador) {
            return view("pages.superadmin");
		}
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    array_push($cursos,$curso); 
                }
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                }
        return view("pages.admin")
			->with("profesor",$profesor)
			->with('infoCursos',$infoCursos);
	}

	/**
	 * Funcion que se encarga de enviar un correo con el formato en pdf de la vista en cuestion tras haber realizado una evaluación por sesión
	 * @param $profesor_id: id del profesor que evalua, $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso, $eval_curso: 
	 * evaluación del curso realizado, $lugar: nombre de la vista a pasar a pdf, $salon: salon donde se toma el curso, $numero_horas: horas totales del curso
	 */
	public function enviarCorreo($profesor_id, $curso_id, $catalogoCurso_id, $eval_curso, $lugar, $salon, $numero_horas){
		//Si el formulario no fue rellenado por un profesor, no hace falta enviar el correo
		if (Session::has('coordinador_id') or Session::has('superadmin'))
			return

		$profesor = Profesor::find($profesor_id);
		$curso = CatalogoCurso::find($curso_id);
		$semestre=Curso::find($curso_id);
		$data = array(
			'name'=>"CDEval",
		);
		
		//Obtenemos el pdf de los datos
		$pdf = PDF::loadView($lugar,array('curso' => $curso,'profesor'=>$profesor,'semestre'=>$semestre,'evaluacion'=>$eval_curso,'salon'=>$salon,'numero_horas'=>$numero_horas));	
		  
		$content = $pdf->download()->getOriginalContent();

		//Obtenemos los profesores de los cursos  
		$profesoresCurso = ProfesoresCurso::where('curso_id',$curso_id)->get();

		//Si es un solo profesor enviamos el mensaje
		if ( count($profesoresCurso) == 1 ){
			$profesor=Profesor::find($profesor_id);
			Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf){
				$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
				$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
				$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
			});
		}else{
			//Sino iteramos a los profesores enviando los mensajes a cada uno de ellos
			foreach($profesoresCurso as $profesorCurso){
				$profesor=Profesor::find($profesorCurso->profesor_id);
				Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf,$semestre){
					$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
					$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
					$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
				});
			}
		}
	}

	/**
	 * Función encargada de redireccionar a la vista de evaluación por sesión adecuada depende de si es o no un seminario el curso
	 * @param  $profesor_id: id del profesor que evalua, $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso
	 * $coutn: número de profesores que tiene el curso
	 * @return La vista donde se realizará la evaluación
	 */
	public function evaluacionPorSesion($profesor_id, $curso_id, $catalogoCurso_id, $count){
		 
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
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
				}
				
		$curso = Curso::find($curso_id);
            
		if($catalogoCurso->tipo == "S"){
            return view("pages.xsesion_seminario")
				->with("profesor",$profesor)
				->with("curso",$curso)
                ->with('catalogoCurso',$catalogoCurso)
                ->with('infoCursos',$infoCursos)
                ->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
                ->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
                   
        }else{
            return view("pages.xsesion")
                ->with("profesor",$profesor)
                ->with("curso",$curso)
                ->with('catalogoCurso',$catalogoCurso)
                ->with('infoCursos',$infoCursos)
                ->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
                ->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
        }
               
    }

	/**
	 * Función encargada de redireccionar a la vista de evaluación final del curso adecuada depende de si es o no un seminario el curso
	 * @param  $profesor_id: id del profesor que evalua, $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso
	 * $coutn: número de profesores que tiene el curso
	 * @return La vista donde se realizará la evaluación
	 */
    public function evaluacionPorCurso($profesor_id, $curso_id, $catalogoCurso_id, $count){
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    array_push($cursos,$curso); 
                }
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
				}
				
		$curso = Curso::find($curso_id);
		if($catalogoCurso->tipo == "S"){
			if($count==1){
                return view("pages.final_seminario_1")
					->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos)
                    ->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
                    ->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}elseif($count==2){
                return view("pages.final_seminario_2")
					->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos)
                    ->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
                    ->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}elseif($count==3){
                return view("pages.final_seminario_3")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos)
                    ->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
                    ->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}      
		}else{
			if($count==1){
				return view("pages.final_curso_1")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos)
					->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
					->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}elseif($count==2){
				return view("pages.final_curso_2")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos)
					->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
					->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}elseif($count==3){
				return view("pages.final_curso_3")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos)
					->with('layout',Session::has('coordinador_id') ? 'layouts.coordinadores' : (Session::has('superadmin') ? 'layouts.app' : 'layouts.principal'))
					->with(Session::has('coordinador_id') ? 'encargado' : (Session::has('superadmin') ? 'coordinaciones' : 'a_') ,Session::has('coordinador_id') ? Coordinacion::findorFail(Session::get('coordinador_id')) : (Session::has('superadmin') ? Coordinacion::all() : '.'));
			}          
		}         
	}
		
	/**
	 * Función encargada de guardar en la base de datos la evaluación final del curso que no es de tipo seminario
	 * @param $request: datos ingresados al formulario, $profesor_id: id del profesro que realizó la evaluación, 
	 * $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso evaluado
	 * @return La vista pages.evaluacionIndex con las indicaciones de que se realizó la evaluación final del curso
	 */
	public function saveFinal_Curso(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
		$eval_fcurso = new EvaluacionFinalCurso;
		$correo = new EvaluacionController(); 
		$participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();
		try{
			$eval_fcurso->participante_curso_id=$participante[0]->id;
			//Obtenemos la fecha actual para usarla en consultas posteriores	
			$date = date("Y-m-j");  
		  
			//1. DESARROLLO DEL CURSO
			$eval_fcurso->p1_1 = $request->p1_1;
			$eval_fcurso->p1_2 = $request->p1_2;
			$eval_fcurso->p1_3 = $request->p1_3;
			$eval_fcurso->p1_4 = $request->p1_4;
			$eval_fcurso->p1_5 = $request->p1_5;
          
			$promedio_p1 = [
				$eval_fcurso->p1_1,
				$eval_fcurso->p1_2,
				$eval_fcurso->p1_3,
				$eval_fcurso->p1_4,
				$eval_fcurso->p1_5
			];
          
			//2. AUTOEVALUACION
			$eval_fcurso->p2_1 = $request->p2_1;
			$eval_fcurso->p2_2 = $request->p2_2;
			$eval_fcurso->p2_3 = $request->p2_3;
			$eval_fcurso->p2_4 = $request->p2_4;
			$promedio_p2 =[
				$eval_fcurso->p2_1,
				$eval_fcurso->p2_2,
				$eval_fcurso->p2_3,
				$eval_fcurso->p2_4 
			];
			
			//3. COORDINACION DEL CURSO
			$eval_fcurso->p3_1 = $request->p3_1;
			$eval_fcurso->p3_2 = $request->p3_2;
			$eval_fcurso->p3_3 = $request->p3_3;
			$eval_fcurso->p3_4 = $request->p3_4;
			$promedio_p3=[
				$eval_fcurso->p3_1,
				$eval_fcurso->p3_2,
				$eval_fcurso->p3_3,
				$eval_fcurso->p3_4
			];			
			
			//4. INSTRUCTOR UNO
			$eval_fcurso->p4_1 = $request->p4_1;
			$eval_fcurso->p4_2 = $request->p4_2;
			$eval_fcurso->p4_3 = $request->p4_3;
			$eval_fcurso->p4_4 = $request->p4_4;
			$eval_fcurso->p4_5 = $request->p4_5;
			$eval_fcurso->p4_6 = $request->p4_6;
			$eval_fcurso->p4_7 = $request->p4_7;
			$eval_fcurso->p4_8 = $request->p4_8;
			$eval_fcurso->p4_9 = $request->p4_9;
			$eval_fcurso->p4_10 = $request->p4_10;
			$eval_fcurso->p4_11 = $request->p4_11;
			$promedio_p4=[
				$eval_fcurso->p4_1,
				$eval_fcurso->p4_2,
				$eval_fcurso->p4_3,
				$eval_fcurso->p4_4,
				$eval_fcurso->p4_5,
				$eval_fcurso->p4_6,
				$eval_fcurso->p4_7,
				$eval_fcurso->p4_8,
				$eval_fcurso->p4_9,
				$eval_fcurso->p4_10,
				$eval_fcurso->p4_11
			];
		
			//5. INSTRUCTOR DOS
			$eval_fcurso->p5_1 = $request->p5_1;
			$eval_fcurso->p5_2 = $request->p5_2;
			$eval_fcurso->p5_3 = $request->p5_3;
			$eval_fcurso->p5_4 = $request->p5_4;
			$eval_fcurso->p5_5 = $request->p5_5;
			$eval_fcurso->p5_6 = $request->p5_6;
			$eval_fcurso->p5_7 = $request->p5_7;
			$eval_fcurso->p5_8 = $request->p5_8;
			$eval_fcurso->p5_9 = $request->p5_9;
			$eval_fcurso->p5_10 = $request->p5_10;
			$eval_fcurso->p5_11 = $request->p5_11;
			$promedio_p5=[
				$eval_fcurso->p5_1,
				$eval_fcurso->p5_2,
				$eval_fcurso->p5_3,
				$eval_fcurso->p5_4,
				$eval_fcurso->p5_5,
				$eval_fcurso->p5_6,
				$eval_fcurso->p5_7,
				$eval_fcurso->p5_8,
				$eval_fcurso->p5_9,
				$eval_fcurso->p5_10,
				$eval_fcurso->p5_11
			];
			
			//6. INSTRUCTOR TRES
			$eval_fcurso->p6_1 = $request->p6_1;
			$eval_fcurso->p6_2 = $request->p6_2;
			$eval_fcurso->p6_3 = $request->p6_3;
			$eval_fcurso->p6_4 = $request->p6_4;
			$eval_fcurso->p6_5 = $request->p6_5;
			$eval_fcurso->p6_6 = $request->p6_6;
			$eval_fcurso->p6_7 = $request->p6_7;
			$eval_fcurso->p6_8 = $request->p6_8;
			$eval_fcurso->p6_9 = $request->p6_9;
			$eval_fcurso->p6_10 = $request->p6_10;
			$eval_fcurso->p6_11 = $request->p6_11;
			$promedio_p6=[
				$eval_fcurso->p6_1,
				$eval_fcurso->p6_2,
				$eval_fcurso->p6_3,
				$eval_fcurso->p6_4,
				$eval_fcurso->p6_5,
				$eval_fcurso->p6_6,
				$eval_fcurso->p6_7,
				$eval_fcurso->p6_8,
				$eval_fcurso->p6_9,
				$eval_fcurso->p6_10,
				$eval_fcurso->p6_11			
			];
				
			//7.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
			$eval_fcurso->p7 = $request->p7;
			//return $eval_fcurso->p7;
			
			//8. ¿CÓMO SE ENTERÓ DEL CURSO?
			$eval_fcurso->p8 = $request->p8;
			//Lo mejor del curso fue:
			$eval_fcurso->mejor = $request->mejor;
			//Sugerencias y recomendaciones:	
			$eval_fcurso->sug = $request->sug;
			//¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
			$eval_fcurso->otros = $request->otros;
			//ÁREA DE CONOCIMIENTO
			$eval_fcurso->conocimiento = $request->conocimiento;
			//Temáticas:	
			$eval_fcurso->tematica = $request->tematica;
			//¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?
			//Horarios Semestrales:
			$eval_fcurso->horarios = $request->horarios;	
			//Horarios Intersemestrales:
			$eval_fcurso->horarioi = $request->horarioi;
			$eval_fcurso->curso_id = $curso_id;
			$eval_fcurso->save();
		} catch (Exception $e){

			//En caso de que no se haya evaluado correctamente el curso regresamos a la vista anterior indicando que la evaluación fue errónea
			Session::flash('message','Favor de contestar todas las preguntas del formulario');
			Session::flash('alert-class', 'alert-danger'); 

			return redirect()->back()->withInput($request->input());
		}
		//Pasos despreciados, usados en versiones antiguas para obtener el promedio de toda la evaluación
		$promedio=[
			$eval_fcurso->p1_1,
			$eval_fcurso->p1_2,
			$eval_fcurso->p1_3,
			$eval_fcurso->p1_4,
			$eval_fcurso->p1_5,
			$eval_fcurso->p2_1,
			$eval_fcurso->p2_2,
			$eval_fcurso->p2_3,
			$eval_fcurso->p2_4,
			$eval_fcurso->p3_1,
			$eval_fcurso->p3_2,
			$eval_fcurso->p3_3,
			$eval_fcurso->p3_4,
			$eval_fcurso->p4_1,
			$eval_fcurso->p4_2,
			$eval_fcurso->p4_3,
			$eval_fcurso->p4_4,
			$eval_fcurso->p4_5,
			$eval_fcurso->p4_6,
			$eval_fcurso->p4_7,
			$eval_fcurso->p4_8,
			$eval_fcurso->p4_9,
			$eval_fcurso->p4_10,
			$eval_fcurso->p4_11,
			$eval_fcurso->p5_1,
			$eval_fcurso->p5_2,
			$eval_fcurso->p5_3,
			$eval_fcurso->p5_4,
			$eval_fcurso->p5_5,
			$eval_fcurso->p5_6,
			$eval_fcurso->p5_7,
			$eval_fcurso->p5_8,
			$eval_fcurso->p5_9,
			$eval_fcurso->p5_10,
			$eval_fcurso->p5_11
		];
		$pg=collect($promedio)->average()*2*10;
		$p1=collect($promedio_p1)->average()*2*10;
		$p2=collect($promedio_p2)->average()*2*10;
		$p3=collect($promedio_p3)->average()*2*10;
		$p4=collect($promedio_p4)->average()*2*10;
		$p5=collect($promedio_p5)->average()*2*10;

		//Actualizar campo de hoja de evaluacion
		DB::table('participante_curso')
			->where('id', $participante[0]->id)
			->where('curso_id',$curso_id)
			->update(['contesto_hoja_evaluacion' => true]);

		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
          
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
	
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    array_push($cursos,$curso); 
                }
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
				}

		//Enviamos a los correos de los profesores como fueron evaluados por dicho y usario y como va la evaluación global
		$this->reporteFinalInstructor($profesor_id,$curso_id,$catalogoCurso_id,$eval_fcurso->id);

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();

		$curso = Curso::find($curso_id);
	 
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su funcionamiento
		if (Session::has('coordinador_id') or Session::has('superadmin')){
			if(Session::has('coordinador_id'))
				return view("pages.superadminCoordinadores")
                    ->with("encargado",Coordinacion::findorFail(Session::get('coordinador_id')));
            return view('pages.superadmin')
               	->with("coordinaciones",Coordinacion::all());
		}
		return view("pages.evaluacionIndex")
			->with("profesor",$profesor)
			->with("curso",$curso)
			->with('catalogoCurso',$catalogoCurso)
			->with('infoCursos',$infoCursos)
			->with('count',$count)
			->with('evaluaciones',$evaluacion_x_curso)
			->with('final',$evaluacion_final_curso)
			->with('msj', 'Evaluación enviada');
	}

	/**
	 * Función encargada de guardar en la base de datos la evaluación final del curso que  es de tipo seminario
	 * @param $request: datos ingresados al formulario, $profesor_id: id del profesro que realizó la evaluación, 
	 * $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso evaluado
	 * @return La vista pages.evaluacionIndex con las indicaciones de que se realizó la evaluación final del curso
	 */
     public function saveFinal_Seminario(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
          $eval_fseminario = new EvaluacionFinalSeminario;
          $promedio_p1 = new EvaluacionFinalSeminario;
		  
          $correo = new EvaluacionController(); 
		  $participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();
		  try{
		  	$eval_fseminario->participante_curso_id=$participante[0]->id;
			$eval_fseminario->curso_id = $curso_id;
			
			
			//1. DESARROLLO DEL CURSO
			$eval_fseminario->p1_1 = $request->p1_1;
			$eval_fseminario->p1_2 = $request->p1_2;
			$eval_fseminario->p1_3 = $request->p1_3;
			$eval_fseminario->p1_4 = $request->p1_4;
			$eval_fseminario->p1_5 = $request->p1_5;

			//2. AUTOEVALUACION
			$eval_fseminario->p2_1 = $request->p2_1;
			$eval_fseminario->p2_2 = $request->p2_2;
			$eval_fseminario->p2_3 = $request->p2_3;
			$eval_fseminario->p2_4 = $request->p2_4;
			//3. COORDINACION DEL CURSO
			$eval_fseminario->p3_1 = $request->p3_1;
			$eval_fseminario->p3_2 = $request->p3_2;
			$eval_fseminario->p3_3 = $request->p3_3;
			$eval_fseminario->p3_4 = $request->p3_4;
			//4. FACILITADOR(A) DEL SEMINARIO
			$eval_fseminario->p4_1 = $request->p4_1;
			$eval_fseminario->p4_2 = $request->p4_2;
			$eval_fseminario->p4_3 = $request->p4_3;
			$eval_fseminario->p4_4 = $request->p4_4;
			$eval_fseminario->p4_5 = $request->p4_5;
			$eval_fseminario->p4_6 = $request->p4_6;
			$eval_fseminario->p4_7 = $request->p4_7;
			$eval_fseminario->p4_8 = $request->p4_8;
			$eval_fseminario->p4_9 = $request->p4_9;
			$eval_fseminario->p4_10 = $request->p4_10;
			$eval_fseminario->p4_11 = $request->p4_11;
			//5. INSTRUCTOR DOS
			$eval_fseminario->p5_1 = $request->p5_1;
			$eval_fseminario->p5_2 = $request->p5_2;
			$eval_fseminario->p5_3 = $request->p5_3;
			$eval_fseminario->p5_4 = $request->p5_4;
			$eval_fseminario->p5_5 = $request->p5_5;
			$eval_fseminario->p5_6 = $request->p5_6;
			$eval_fseminario->p5_7 = $request->p5_7;
			$eval_fseminario->p5_8 = $request->p5_8;
			$eval_fseminario->p5_9 = $request->p5_9;
			$eval_fseminario->p5_10 = $request->p5_10;
			$eval_fseminario->p5_11 = $request->p5_11;
			$promedio_p5=[
				$eval_fseminario->p5_1,
				$eval_fseminario->p5_2,
				$eval_fseminario->p5_3,
				$eval_fseminario->p5_4,
				$eval_fseminario->p5_5,
				$eval_fseminario->p5_6,
				$eval_fseminario->p5_7,
				$eval_fseminario->p5_8,
				$eval_fseminario->p5_9,
				$eval_fseminario->p5_10,
				$eval_fseminario->p5_11
			];
			//6. INSTRUCTOR TRES
			$eval_fseminario->p6_1 = $request->p6_1;
			$eval_fseminario->p6_2 = $request->p6_2;
			$eval_fseminario->p6_3 = $request->p6_3;
			$eval_fseminario->p6_4 = $request->p6_4;
			$eval_fseminario->p6_5 = $request->p6_5;
			$eval_fseminario->p6_6 = $request->p6_6;
			$eval_fseminario->p6_7 = $request->p6_7;
			$eval_fseminario->p6_8 = $request->p6_8;
			$eval_fseminario->p6_9 = $request->p6_9;
			$eval_fseminario->p6_10 = $request->p6_10;
			$eval_fseminario->p6_11 = $request->p6_11;
			$promedio_p6=[
				$eval_fseminario->p6_1,
				$eval_fseminario->p6_2,
				$eval_fseminario->p6_3,
				$eval_fseminario->p6_4,
				$eval_fseminario->p6_5,
				$eval_fseminario->p6_6,
				$eval_fseminario->p6_7,
				$eval_fseminario->p6_8,
				$eval_fseminario->p6_9,
				$eval_fseminario->p6_10,
				$eval_fseminario->p6_11
			];
			//6.¿RECOMENDARÍA EL CURSO A OTROS PROFESORES?
			$eval_fseminario->p7 = $request->p7;
			//7. ¿CÓMO SE ENTERÓ DEL CURSO?
			$eval_fseminario->p8 = $request->p8;

			//Lo que me aportó el seminario fue:
			$eval_fseminario->aporto = $request->aporto;
			//Sugerencias y recomendaciones:	
			$eval_fseminario->sug = $request->sug;
			//¿Qué otros cursos, talleres, seminarios o temáticos le gustaría que se impartiesen o tomasen en cuenta para próximas actividades?
			$eval_fseminario->otros = $request->otros;
			//ÁREA DE CONOCIMIENTO
			$eval_fseminario->conocimiento = $request->conocimiento;
			//Temáticas:	
			$eval_fseminario->tematica = $request->tematica;
			//¿En qué horarios le gustaría que se impartiesen los cursos, talleres, seminarios o diplomados?
			//Horarios Semestrales:
			$eval_fseminario->horarios = $request->horarios;	
			//Horarios Intersemestrales:
			$eval_fseminario->horarioi = $request->horarioi;
			$eval_fseminario->save();
		  } catch(Exception $e){

			//En caso de que no se haya evaluado correctamente el curso regresamos a la vista anterior indicando que la evaluación fue errónea
			Session::flash('message','Favor de contestar todas las preguntas del formulario');
			Session::flash('alert-class', 'alert-danger'); 

			return redirect()->back()->withInput($request->input());
		  }

		  //Pasos despreciados en la version actual, usados para obtener el promedio de toda la evaluación del curso
          $promedio_p1 = [
               $eval_fseminario->p1_1,
               $eval_fseminario->p1_2,
               $eval_fseminario->p1_3,
               $eval_fseminario->p1_4,
               $eval_fseminario->p1_5];
$promedio_p2 =[
               $eval_fseminario->p2_1,
               $eval_fseminario->p2_2,
               $eval_fseminario->p2_3,
               $eval_fseminario->p2_4];
 $promedio_p3=[
               $eval_fseminario->p3_1,
               $eval_fseminario->p3_2,
               $eval_fseminario->p3_3,
               $eval_fseminario->p3_4];
$promedio_p4=[
               $eval_fseminario->p4_1,
               $eval_fseminario->p4_2,
               $eval_fseminario->p4_3,
               $eval_fseminario->p4_4,
               $eval_fseminario->p4_5,
               $eval_fseminario->p4_6,
               $eval_fseminario->p4_7,
               $eval_fseminario->p4_8,
               $eval_fseminario->p4_9,
               $eval_fseminario->p4_10,
               $eval_fseminario->p4_11];
               $promedio=[
               $eval_fseminario->p1_1,
               $eval_fseminario->p1_2,
               $eval_fseminario->p1_3,
               $eval_fseminario->p1_4,
               $eval_fseminario->p1_5,
               $eval_fseminario->p2_1,
               $eval_fseminario->p2_2,
               $eval_fseminario->p2_3,
               $eval_fseminario->p2_4,
               $eval_fseminario->p3_1,
               $eval_fseminario->p3_2,
               $eval_fseminario->p3_3,
               $eval_fseminario->p3_4,
               $eval_fseminario->p4_1,
               $eval_fseminario->p4_2,
               $eval_fseminario->p4_3,
               $eval_fseminario->p4_4,
               $eval_fseminario->p4_5,
               $eval_fseminario->p4_6,
               $eval_fseminario->p4_7,
               $eval_fseminario->p4_8,
               $eval_fseminario->p4_9,
               $eval_fseminario->p4_10,
               $eval_fseminario->p4_11
               ];

          $p1=collect($promedio_p1)->average()*2*10;
          $p2=collect($promedio_p2)->average()*2*10;
          $p3=collect($promedio_p3)->average()*2*10;
          $p4=collect($promedio_p4)->average()*2*10;
          $pg=collect($promedio)->average()*2*10;
		  
          //Actualizar tabla en la bd
          DB::table('participante_curso')
          ->where('id', $participante[0]->id)
          ->where('curso_id',$curso_id)
		  ->update(['contesto_hoja_evaluacion' => true]);
		  
		//Actualizar campo de hoja de evaluacion
		DB::table('participante_curso')
			->where('id', $participante[0]->id)
			->where('curso_id',$curso_id)
			->update(['contesto_hoja_evaluacion' => true]);

		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
          
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
	
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    //return $curso;
                    array_push($cursos,$curso); 
                }
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                }

		//Enviamos a los correos de los profesores como fueron evaluados por dicho y usario y como va la evaluación global
		//return $this->reporteFinalInstructorSeminario($profesor_id,$curso_id,$catalogoCurso_id,$eval_fseminario->id);
		$this->reporteFinalInstructorSeminario($profesor_id,$curso_id,$catalogoCurso_id,$eval_fseminario->id);

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where('participante_curso_id',$participante[0]->id)
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
			->select('_evaluacion_final_seminario.participante_curso_id','_evaluacion_final_seminario.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$participante[0]->id]])
			->get();

		$curso = Curso::find($curso_id);

		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su funcionamiento
		if (Session::has('coordinador_id') or Session::has('superadmin')){
			if(Session::has('coordinador_id'))
				return view("pages.superadminCoordinadores")
                    ->with("encargado",Coordinacion::findorFail(Session::get('coordinador_id')));
            return view('pages.superadmin')
               	->with("coordinaciones",Coordinacion::all());
		}
		return view("pages.evaluacionIndex")
			->with("profesor",$profesor)
			->with("curso",$curso)
			->with('catalogoCurso',$catalogoCurso)
			->with('infoCursos',$infoCursos)
			->with('count',$count)
			->with('evaluaciones',array())
			->with('final',$evaluacion_final_curso)
			->with('msj', 'Evaluación enviada');
     }
     

	 /**
	 * Función encargada de guardar en la base de datos la evaluación por sesión del curso que no es de tipo seminario
	 * @param $request: datos ingresados al formulario, $profesor_id: id del profesro que realizó la evaluación, 
	 * $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso evaluado
	 * @return La vista pages.evaluacionIndex con las indicaciones de que se realizó la evaluación del día actual de la sesión del curso
	 */
     public function saveXCurso(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
          $eval_xcurso = new EvaluacionXCurso;
          $correo = new EvaluacionController(); 
		  $participante = ParticipantesCurso::where([['profesor_id',$profesor_id],['curso_id',$curso_id]])->get('id');
		  $semestre=Curso::find($curso_id);
		  $participanteID = intval($participante[0]->id);
		  //Obtenemos la fecha actual para usarla en consultas posteriores	
		  $date = date("Y-m-j");
		  
		  //Guardamos en _evaluacion_x_curso todos los datos ingresados por el alumno en la encuesta
		try{
          	$eval_xcurso->participante_curso_id=$participanteID;
          	$eval_xcurso->p1=$request->p1;
          	$eval_xcurso->p2=$request->p2;
          	$eval_xcurso->p3=$request->p3;
          	$eval_xcurso->p4=$request->p4;
          	$eval_xcurso->p5=$request->p5;
          	$eval_xcurso->p6=$request->p6;
          	$eval_xcurso->p7=$request->p7;
          	$eval_xcurso->contenido=$request->contenido;
          	$eval_xcurso->sug=$request->sug;
		  	$eval_xcurso->created_at=$date;
		  	$eval_xcurso->curso_id=$curso_id;
			  $eval_xcurso->save();
		}catch(Exception $e){

			//En caso de que no se haya evaluado correctamente el curso regresamos a la vista anterior indicando que se debe de repetir la evaluación
			Session::flash('message','Favor de contestar todas las preguntas del formulario');
			Session::flash('alert-class', 'alert-danger'); 

			return redirect()->back()->withInput($request->input());
		}
		  
          $promedio=[
               $eval_xcurso->p1,
               $eval_xcurso->p2,
               $eval_xcurso->p3,
               $eval_xcurso->p4,
               $eval_xcurso->p5,
               $eval_xcurso->p6,
               $eval_xcurso->p7
          ];
          $pg=collect($promedio)->average()*2*10;
		
		  //Ya guardada la encuesta buscamos obtener los cursos en los que está inscrito el profesor
		  $profesor = Profesor::find($profesor_id);
		  $curso = Curso::find($curso_id);
		  $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		
		  $count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();

			//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
			$infoCursos=array(); 
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
                }
	
		//Obtenemos la evaluacion recien realizada para enviarla por correo
		$eval_xcurso = DB::table('_evaluacion_x_curso')
			->select('*')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();
	
		//Obtenemos la evaluación actual
		$eval_curso = $eval_xcurso[0];

		//Obtenemos el salón donde se realizó el curso
		$salon = DB::table('salons')
			->where('id',$curso->salon_id)
			->get();

		//Obtrenemos el número de horas en que consta el curso
		$horas_inicio = explode(':',$curso->hora_inicio);
		$horas_fin = explode(':',$curso->hora_fin);
	
		$inicio = intval($horas_inicio[0]) + floatval($horas_inicio[1]/100);
		$fin = intval($horas_fin[0]) + floatval($horas_fin[1]/100);
	
		$numero_horas = floatval($curso->numero_sesiones) * ($fin-$inicio);

		//Enviamos el correo con los datos a usar
		$correo->enviarCorreo($profesor_id,$curso_id, $catalogoCurso_id, $eval_curso, 'pages.evaluacion_x_curso',$salon,$numero_horas);

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();

		$curso = Curso::find($curso_id);
			
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su correcto funcionamiento
		if (Session::has('coordinador_id') or Session::has('superadmin')){
			if(Session::has('coordinador_id'))
				return view("pages.superadminCoordinadores")
                    ->with("encargado",Coordinacion::findorFail(Session::get('coordinador_id')));
            return view('pages.superadmin')
               	->with("coordinaciones",Coordinacion::all());
		}
		return view("pages.evaluacionIndex")
			->with("profesor",$profesor)
			->with("curso",$curso)
			->with('catalogoCurso',$catalogoCurso)
			->with('infoCursos',$infoCursos)
			->with('count',$count)
			->with('evaluaciones',$evaluacion_x_curso)
			->with('final',$evaluacion_final_curso)
			->with('msj', 'Evaluación enviada');
          
     }

	 /**
	 * Función encargada de guardar en la base de datos la evaluación por sesión del curso que es de tipo seminario
	 * @param $request: datos ingresados al formulario, $profesor_id: id del profesro que realizó la evaluación, 
	 * $curso_id: id del curso evaluado, $catalogoCurso_id: id del catalogo del curso evaluado
	 * @return La vista pages.evaluacionIndex con las indicaciones de que se realizó la evaluación del día actual de la sesión del curso
	 */
     public function saveXSeminario(Request $request,$profesor_id,$curso_id,$catalogoCurso_id){
          $eval_xseminario = new EvaluacionXSeminario;
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::where([['profesor_id',$profesor_id],['curso_id',$curso_id]])->get('id');
		  $semestre=Curso::find($curso_id);
		  $participanteID = $participante[0]->id;

		  //Guardamos en _evaluacion_x_curso todos los datos ingresados por el alumno en la encuesta
		  try{
			$eval_xseminario->participante_curso_id=$participanteID;
			$eval_xseminario->p1=$request->p1;
			$eval_xseminario->p1_arg=$request->p1_arg;
			$eval_xseminario->p2=$request->p2;
			$eval_xseminario->p2_arg=$request->p2_arg;
			$eval_xseminario->p3=$request->p3;
			$eval_xseminario->p3_arg=$request->p3_arg;
			$eval_xseminario->p4=$request->p4;
			$eval_xseminario->p4_arg=$request->p4_arg;
			$eval_xseminario->p5=$request->p5;
			$eval_xseminario->p5_arg=$request->p5_arg;
			$eval_xseminario->p6=$request->p6;
			$eval_xseminario->p6_arg=$request->p6_arg;
			$eval_xseminario->curso_id=$curso_id;

			$date = date("Y-m-j");  

			$eval_xseminario->created_at = $date;

			$eval_xseminario->save();
		  }catch(Exception $e){

			//En caso de que no se haya evaluado correctamente el curso regresamos a la vista anterior indicando que se debe de repetir la evaluación
			Session::flash('message','Favor de contestar todas las preguntas del formulario');
			Session::flash('alert-class', 'alert-danger'); 

			return redirect()->back()->withInput($request->input());
		  }
          $profesor = Profesor::find($profesor_id);
		  $curso = Curso::find($curso_id);
		  $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		
		  $count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();

			//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
			$infoCursos=array(); 
			$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
                $cursos=array();
                foreach($participantesCurso as $participanteCurso){
                    $curso=Curso::findorFail($participanteCurso->curso_id);
                    array_push($cursos,$curso); 
                }
                foreach($cursos as $curso){
                    $catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
                    $tupla = array();
                    array_push($tupla,$curso);
                    array_push($tupla,$catalogoCursos);
                    array_push($infoCursos, $tupla);
                }
	

		//Obtenemos la evaluacion recien realizada para enviarla por correo
		$eval_xcurso = DB::table('_evaluacion_x_seminario')
			->select('*')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();
	 
		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();
		

		$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
			->select('_evaluacion_final_seminario.participante_curso_id','_evaluacion_final_seminario.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$participanteID]])
			->get();
			

		$curso = Curso::find($curso_id);
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su correcto funcionamiento
		if (Session::has('coordinador_id') or Session::has('superadmin')){
			if(Session::has('coordinador_id'))
				return view("pages.superadminCoordinadores")
                    ->with("encargado",Coordinacion::findorFail(Session::get('coordinador_id')));
            return view('pages.superadmin')
               	->with("coordinaciones",Coordinacion::all());
		}
		return view("pages.evaluacionIndex")
			->with("profesor",$profesor)
			->with("curso",$curso)
			->with('catalogoCurso',$catalogoCurso)
			->with('infoCursos',$infoCursos)
			->with('count',$count)
			->with('evaluaciones',$evaluacion_x_curso)
			->with('final',$evaluacion_final_curso)
			->with('msj', 'Evaluación enviada');
          
          
     }
	
	/**
	 * Función encargada de enviar el historial de cursos tomados por el profesor
	 * @param $request: petición (vacía) del usuario, $id del profesor del que se desean obtener los datos
	 * @return la vista pages.admin
	 */
	public function enviarClaveCrusoHistorico(Request $request, $profesor_id){
		//Si el formulario no fue rellenado por un profesor, no hace falta enviar el correo
		if (Session::has('coordinador_id') or Session::has('superadmin'))
			return


		//Obtenemos todos los cursos en los que ha participado el profesor
		$cursosParticipante=DB::table('participante_curso')
			->select('curso_id')
			->where('profesor_id',$profesor_id)
			->get();
			
		$data = array(
			'name'=>"CDEval",
		);
		
		$cursos = array();
		
		//Guardamos los datos de los cursos en los que ha participado el profesor dentro de un arreglo
		foreach($cursosParticipante as $cursosParticipante){
			$datos = array();
			$curso = DB::table('cursos')
				->join('catalogo_cursos','cursos.catalogo_id','=','catalogo_cursos.id')
				->join('coordinacions','catalogo_cursos.coordinacion_id','=','coordinacions.id')
				->select('catalogo_cursos.nombre_curso','catalogo_cursos.duracion_curso','catalogo_cursos.clave_curso','catalogo_cursos.tipo','coordinacions.nombre_coordinacion')
				->where('cursos.id',$cursosParticipante->curso_id)
				->get();
			array_push($cursos, $curso);
		}


		
		//Creamos un pdf con la información de los cursos tomados y también lo enviamos por correo
		$pdf = PDF::loadView('pages.concentrado_claves_curso_historico',array('cursos' => $cursos));
		$profesor=Profesor::find($profesor_id);
		Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf){
			$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
			$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Historial');
			$message->attachData($pdf->output(), 'Historial de cursos.pdf');
		});
		
		$infoCursos=array(); 
		$cursos=array();
		
		//Obtenemos los cursos en donde ha participado el profesor
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
            $cursos=array();
            foreach($participantesCurso as $participanteCurso){
            $curso=Curso::findorFail($participanteCurso->curso_id);
            array_push($cursos,$curso); 
        }
		
		//
		foreach($cursos as $curso){
            $catalogoCursos = CatalogoCurso::find($curso->id);
            $tupla = array();
            array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
            array_push($infoCursos, $tupla);
        }
		
		//regresamos a la vista pages.admin con los datos necesarios para su funcionamiento
		return View::make('pages.admin')
			->with('profesor',$profesor)
			->with('infoCursos',$infoCursos)
			->with('msj','Claves enviadas');
		
	}
	
	/**
	 * Función encarga de enviar a la vista en donde el usuario elegirá la fecha de los cursos de su historial a revisar
	 * @param $request: petición (vacía) del usuario, $id del profesor del que se desean obtener los datos
	 * @return la vista pages.enviar_por_fecha donde el usuario eligirá la fecha que desea observar
	 */
	public function redirigirAEnviar(Request $request, $profesor_id){
		
		//Obtenemos los cursos en donde ha participado el profesor y los guardamos en un array
		$infoCursos=array(); 
		$cursos=array();
		
		$profesor=Profesor::find($profesor_id);
		
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
            $cursos=array();
            foreach($participantesCurso as $participanteCurso){
            $curso=Curso::findorFail($participanteCurso->curso_id);
            array_push($cursos,$curso); 
        }
		
		foreach($cursos as $curso){
            $catalogoCursos = CatalogoCurso::find($curso->id);
            $tupla = array();
            array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
            array_push($infoCursos, $tupla);
		}
		
		$cursos = DB::table('cursos')
            ->get();

        $fechas = array();
        foreach($cursos as $curso){
            $fecha = strval($curso->semestre_anio).'-'.strval($curso->semestre_pi);
            $inList = false;
            foreach($fechas as $fechaIn){
                if(strcmp($fechaIn,$fecha)==0){
                    $inList = True;
                    break;
                }
            }
            if($inList == false){
                array_push($fechas,$fecha);
            }
        }
		
		//Redireccionamoes a la pagina de selección de semestre
		return View::make('pages.enviar_por_fecha')
			->with('profesor',$profesor)
			->with('infoCursos',$infoCursos)
			->with('fechas',$fechas);
	}

	/**
	 * Función encargada de enviar el correo con los cursos que tomó el usuario en la fecha seleccionada
	 * @param $request: fecha elegida por el usuario, $profesor_id: id del ususario
	 * @return La vista pages.admin
	 */
	public function enviarClaveFecha(Request $request, $profesor_id){
		//Si el formulario no fue rellenado por un profesor, no hace falta enviar el correo
		if (Session::has('coordinador_id') or Session::has('superadmin'))
			return


		//Obtenemos el semestre aceptado por el usuario y lo dividimos entre -
		$semestre = $request->get('semestre');
		$fecha_semestre = explode('-',$semestre);
		
		//Obtenemos los cursos en los que ha estado inscrito el profesor
		$cursos_tomados=DB::table('participante_curso')
			->where('profesor_id',$profesor_id)
			->get();

		$cursos=array();
			
		//Iteramos los cursos y obtenemos su informacion
		foreach($cursos_tomados as $curso_tomado){
			$curso = DB::table('cursos')
				->join('catalogo_cursos','cursos.catalogo_id','=','catalogo_cursos.id')
				->join('coordinacions','catalogo_cursos.coordinacion_id','=','coordinacions.id')
				->select('catalogo_cursos.nombre_curso','catalogo_cursos.duracion_curso','catalogo_cursos.clave_curso','catalogo_cursos.tipo','coordinacions.nombre_coordinacion')
				->where('cursos.id',$curso_tomado->curso_id)
				->get();
			
			$curso_lista=DB::table('cursos')
				->select('*')
				->where('id',$curso_tomado->curso_id)
				->get();
			
			//Si el curso corresponde al semestre ingresado por el profesor entonces lo guardamos en la lista
			if($curso_lista[0]->semestre_anio==$fecha_semestre[0] && $curso_lista[0]->semestre_pi==$fecha_semestre[1]){
				array_push($cursos,$curso);
			}
			
		}
		
		$data = array(
			'name'=>"CDEval",
		);
		
		//Creamos el pdf con los cursos tomados en el semestre especificado y lo mandamos por correo
		$pdf = PDF::loadView('pages.concentrado_claves_curso_periodo',array('cursos' => $cursos, 'semestre'=>$semestre));
		$profesor=Profesor::find($profesor_id);
		Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf){
			$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
			$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Historial');
			$message->attachData($pdf->output(), 'Historial de cursos por periodo.pdf');
		});
		
		//Pasos necesarios para obtener las ligas a los cursos en los que está inscrito el usuario
		$infoCursos=array(); 
		$profesor = Profesor::find($profesor_id);
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor_id)->get();
		$cursos=array();
		foreach($participantesCurso as $participanteCurso){
			$curso=Curso::findorFail($participanteCurso->curso_id);
			array_push($cursos,$curso); 
		}
		foreach($cursos as $curso){
			$catalogoCursos = CatalogoCurso::find($curso->catalogo_id);
			$tupla = array();
			array_push($tupla,$curso);
			array_push($tupla,$catalogoCursos);
			array_push($infoCursos, $tupla);
		}
		
		//Retornamos la vista pages.admin con los datos necesarios para su funcionamiento
		return View::make('pages.admin')
			->with('profesor',$profesor)
			->with('infoCursos',$infoCursos)
			->with('msj','Claves enviadas');
			
	}

	/**
	 * Función encargada de enviar el reporte de Instructores global evaluación de curso
	 * @param $profesor_id: profesor que realizó la evaluación, $curso_id: id del curso evaluado,
	 * $catalogoCurso_id: id del catalogo del curso evaludo, $eval_id: id de la evaluación realizada
	 */
	public function reporteFinalInstructor($profesor_id,$curso_id,$catalogoCurso_id,$eval_id){
		//Si el formulario no fue rellenado por un profesor, no hace falta enviar el correo
		if (Session::has('coordinador_id') or Session::has('superadmin'))
			return

		//Obtenemos el curso evaluado
		$curso = DB::table('cursos')
			->where('id',$curso_id)
			->get();
		//Obtenemos el catálogo del curso evaluado
		$catalogoCurso = DB::table('catalogo_cursos')
			->where('id',$catalogoCurso_id)
			->get();
		//Obtenemos todas las evaluaciones del curso
		$evals = DB::table('_evaluacion_final_curso')
			->where('curso_id',$curso_id)
			->get();
	
		//Obtenemos los docentes/facilitadores de los cursos y su número
		$profesorsDatos = DB::table('profesor_curso')
			->where('curso_id',$curso[0]->id)
			->get();

		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
	
		$profesors = array();
	
		//Obtenemos los datos de los docentes
		foreach($profesorsDatos as $Dato){
			$profesor = Profesor::find($Dato->id);
			array_push($profesors,$profesor);
		}

		//Empezamps la evaluación del curso
		$mejor = array(); //mejor
		$sugerencias = array(); //sug
		$lugar = 'pages.reporte_final_instructores_1';
		$experiencia1 = 0; //4_1
		$planeacion1 = 0;	//4_2
		$puntualidad1 = 0;	//4_3
		$materiales1 = 0;	//4_4
		$dudas1 = 0;		//4_5
		$control1 = 0;		//4_6
		$interes1 = 0;		//4_6
		$actitud1 = 0;		//4_8
		$experiencia2 = 0;
		$planeacion2 = 0;
		$puntualidad2 = 0;
		$materiales2 = 0;
		$dudas2 = 0;
		$control2 = 0;
		$interes2 = 0;
		$actitud2 = 0;
		$experiencia3 = 0;
		$planeacion3 = 0;
		$puntualidad3 = 0;
		$materiales3 = 0;
		$dudas3 = 0;
		$control3 = 0;
		$interes3 = 0;
		$actitud3 = 0;

		//Iteramos todas las evaluaciones para ir sumando los valores de las evaluaciones
		foreach($evals as $eval){

			$experiencia1 += $eval->p4_1; //4_1
			$planeacion1 += $eval->p4_2;	//4_2
			$puntualidad1 += $eval->p4_3;	//4_3
			$materiales1 += $eval->p4_4;	//4_4
			$dudas1 += $eval->p4_5;		//4_5
			$control1 += $eval->p4_6;		//4_6
			$interes1 += $eval->p4_7;		//4_7
			$actitud1 += $eval->p4_8;		//4_8
	
			//Si hay dos profesores obtenemos la evaluación del segundo docente
			if($count>=2){
				$lugar = 'pages.reporte_final_instructores_2';
				$experiencia2 += $eval->p5_1;
				$planeacion2 += $eval->p5_2;
				$puntualidad2 += $eval->p5_3;
				$materiales2 += $eval->p5_4;
				$dudas2 += $eval->p5_5;
				$control2 += $eval->p5_6;
				$interes2 += $eval->p5_7;
				$actitud2 += $eval->p5_8;
			}

			//Si hay tres docentes obtenemos la evaluación del tercero
			if($count == 3){
				$lugar = 'pages.reporte_final_instructores_3';
				$experiencia3 += $eval->p6_1;
				$planeacion3 += $eval->p6_2;
				$puntualidad3 += $eval->p6_3;
				$materiales3 += $eval->p6_4;
				$dudas3 += $eval->p6_5;
				$control3 += $eval->p6_6;
				$interes3 += $eval->p6_7;
				$actitud3 += $eval->p6_8;
			}

			array_push($mejor,$eval->mejor);
			array_push($sugerencias,$eval->sug);

		}


		//Obtenemos los promedios de cada profesor
		$experiencia1 = round($experiencia1/sizeof($evals),2);
		$planeacion1 = round($planeacion1/sizeof($evals),2);	//4_2
		$puntualidad1 = round($puntualidad1/sizeof($evals),2);	//4_3
		$materiales1 = round($materiales1/sizeof($evals),2);	//4_4
		$dudas1 = round($dudas1/sizeof($evals),2);		//4_5
		$control1 = round($control1/sizeof($evals),2);		//4_6
		$interes1 = round($interes1/sizeof($evals),2);		//4_7
		$actitud1 = round($actitud1/sizeof($evals),2);	

		$experiencia2 = round($experiencia2/sizeof($evals),2);
		$planeacion2 = round($planeacion2/sizeof($evals),2);	//4_2
		$puntualidad2 = round($puntualidad2/sizeof($evals),2);	//4_3
		$materiales2 = round($materiales2/sizeof($evals),2);	//4_4
		$dudas2 = round($dudas2/sizeof($evals),2);		//4_5
		$control2 = round($control2/sizeof($evals),2);		//4_6
		$interes2 = round($interes2/sizeof($evals),2);		//4_7
		$actitud2 = round($actitud2/sizeof($evals),2);	
		
		$experiencia3 = round($experiencia3/sizeof($evals),2);
		$planeacion3 = round($planeacion3/sizeof($evals),2);	//4_2
		$puntualidad3 = round($puntualidad3/sizeof($evals),2);	//4_3
		$materiales3 = round($materiales3/sizeof($evals),2);	//4_4
		$dudas3 = round($dudas3/sizeof($evals),2);		//4_5
		$control3 = round($control3/sizeof($evals),2);		//4_6
		$interes3 = round($interes3/sizeof($evals),2);		//4_7
		$actitud3 = round($actitud3/sizeof($evals),2);	
	
		$envio = $catalogoCurso[0]->nombre_curso.'_'.$eval_id;
		
		//Obtenemos el pdf
		$pdf = PDF::loadView($lugar,array('experiencia1'=>$experiencia1,'planeacion1'=>$planeacion1,'puntualidad1'=>$puntualidad1,'materiales1'=>$materiales1,'dudas1'=>$dudas1,'control1'=>$control1,'interes1'=>$interes1,'actitud1'=>$actitud1,'experiencia2'=>$experiencia2,'planeacion2'=>$planeacion2,'puntualidad2'=>$puntualidad2,'materiales2'=>$materiales2,'dudas2'=>$dudas2,'control2'=>$control2,'interes2'=>$interes2,'actitud2'=>$actitud2,'experiencia3'=>$experiencia3,'planeacion3'=>$planeacion3,'puntualidad3'=>$puntualidad3,'materiales3'=>$materiales3,'dudas3'=>$dudas3,'control3'=>$control3,'interes3'=>$interes3,'actitud3'=>$actitud3,'mejor'=>$mejor,'sugerencias'=>$sugerencias,'catalogo'=>$catalogoCurso[0],'curso'=>$curso[0],'cursos'=>$curso[0],'profesors'=>$profesors,'eval_id'=>$eval_id));	
		//return $pdf->download($envio.'.pdf');
	
		$profesoresCurso = ProfesoresCurso::where('curso_id',$curso_id)->get();
	
		$semestre = $curso[0]->semestre_anio;
	
		//Obtenemos los datos de los docentes/facilitadores y enviamos el correo
		$data = array(
			'name'=>"CDEval",
		);
	
		foreach($profesoresCurso as $profesorCurso){
			$profesor=Profesor::find($profesorCurso->profesor_id);
			Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf,$semestre){
				$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
				$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
				$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
			});
		}
	
	}

	public function reporteFinalInstructorSeminario($profesor_id,$curso_id,$catalogoCurso_id,$eval_id){
		//Si el formulario no fue rellenado por un profesor, no hace falta enviar el correo
		if (Session::has('coordinador_id') or Session::has('superadmin'))
			return

		//Obtenemos el curso evaluado
		$curso = DB::table('cursos')
			->where('id',$curso_id)
			->get();
		//Obtenemos el catálogo del curso evaluado
		$catalogoCurso = DB::table('catalogo_cursos')
			->where('id',$catalogoCurso_id)
			->get();

		//Obtenemos todas las evaluaciones del curso
		$evals = DB::table('_evaluacion_final_seminario')
			->where('curso_id',$curso_id)
			->get();
	
		//Obtenemos los docentes/facilitadores de los cursos y su número
		$profesorsDatos = DB::table('profesor_curso')
			->where('curso_id',$curso[0]->id)
			->get();

		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
	
		$profesors = array();
	
		//Obtenemos los datos de los docentes
		foreach($profesorsDatos as $Dato){
			$profesor = Profesor::find($Dato->id);
			array_push($profesors,$profesor);
		}
	
		$cursos = Curso::find($curso_id)->get();
	
		//Empezamps la evaluación del curso
		$mejor = array(); //mejor
		$sugerencias = array(); //sug
		$lugar = 'pages.reporte_final_seminario_instructores_1';
		$experiencia1 = 0; //4_1
		$planeacion1 = 0;	//4_2
		$puntualidad1 = 0;	//4_3
		$materiales1 = 0;	//4_4
		$dudas1 = 0;		//4_5
		$control1 = 0;		//4_6
		$interes1 = 0;		//4_6
		$actitud1 = 0;		//4_8
		$experiencia2 = 0;
		$planeacion2 = 0;
		$puntualidad2 = 0;
		$materiales2 = 0;
		$dudas2 = 0;
		$control2 = 0;
		$interes2 = 0;
		$actitud2 = 0;
		$experiencia3 = 0;
		$planeacion3 = 0;
		$puntualidad3 = 0;
		$materiales3 = 0;
		$dudas3 = 0;
		$control3 = 0;
		$interes3 = 0;
		$actitud3 = 0;

		//Iteramos todas las evaluaciones para ir sumando los valores de las evaluaciones
		foreach($evals as $eval){

			$experiencia1 += $eval->p4_1; //4_1
			$planeacion1 += $eval->p4_2;	//4_2
			$puntualidad1 += $eval->p4_3;	//4_3
			$materiales1 += $eval->p4_4;	//4_4
			$dudas1 += $eval->p4_5;		//4_5
			$control1 += $eval->p4_6;		//4_6
			$interes1 += $eval->p4_7;		//4_7
			$actitud1 += $eval->p4_8;		//4_8
	
			//Si hay dos profesores obtenemos la evaluación del segundo docente
			if($count>=2){
				$lugar = 'pages.reporte_final_seminario_instructores_2';
				$experiencia2 += $eval->p5_1;
				$planeacion2 += $eval->p5_2;
				$puntualidad2 += $eval->p5_3;
				$materiales2 += $eval->p5_4;
				$dudas2 += $eval->p5_5;
				$control2 += $eval->p5_6;
				$interes2 += $eval->p5_7;
				$actitud2 += $eval->p5_8;
			}

			//Si hay tres docentes obtenemos la evaluación del tercero
			if($count == 3){
				$lugar = 'pages.reporte_final_seminario_instructores_3';
				$experiencia3 += $eval->p6_1;
				$planeacion3 += $eval->p6_2;
				$puntualidad3 += $eval->p6_3;
				$materiales3 += $eval->p6_4;
				$dudas3 += $eval->p6_5;
				$control3 += $eval->p6_6;
				$interes3 += $eval->p6_7;
				$actitud3 += $eval->p6_8;
			}

			array_push($mejor,$eval->aporto);
			array_push($sugerencias,$eval->sug);

		}


		//Obtenemos los promedios de cada profesor
		$experiencia1 = round($experiencia1/sizeof($evals),2);
		$planeacion1 = round($planeacion1/sizeof($evals),2);	//4_2
		$puntualidad1 = round($puntualidad1/sizeof($evals),2);	//4_3
		$materiales1 = round($materiales1/sizeof($evals),2);	//4_4
		$dudas1 = round($dudas1/sizeof($evals),2);		//4_5
		$control1 = round($control1/sizeof($evals),2);		//4_6
		$interes1 = round($interes1/sizeof($evals),2);		//4_7
		$actitud1 = round($actitud1/sizeof($evals),2);	

		$experiencia2 = round($experiencia2/sizeof($evals),2);
		$planeacion2 = round($planeacion2/sizeof($evals),2);	//4_2
		$puntualidad2 = round($puntualidad2/sizeof($evals),2);	//4_3
		$materiales2 = round($materiales2/sizeof($evals),2);	//4_4
		$dudas2 = round($dudas2/sizeof($evals),2);		//4_5
		$control2 = round($control2/sizeof($evals),2);		//4_6
		$interes2 = round($interes2/sizeof($evals),2);		//4_7
		$actitud2 = round($actitud2/sizeof($evals),2);	
		
		$experiencia3 = round($experiencia3/sizeof($evals),2);
		$planeacion3 = round($planeacion3/sizeof($evals),2);	//4_2
		$puntualidad3 = round($puntualidad3/sizeof($evals),2);	//4_3
		$materiales3 = round($materiales3/sizeof($evals),2);	//4_4
		$dudas3 = round($dudas3/sizeof($evals),2);		//4_5
		$control3 = round($control3/sizeof($evals),2);		//4_6
		$interes3 = round($interes3/sizeof($evals),2);		//4_7
		$actitud3 = round($actitud3/sizeof($evals),2);	
	
		$envio = $catalogoCurso[0]->nombre_curso.'_'.$eval_id;

		//return $profesors[0];
		
		//Obtenemos el pdf
		$pdf = PDF::loadView($lugar,array('experiencia1'=>$experiencia1,'planeacion1'=>$planeacion1,'puntualidad1'=>$puntualidad1,'materiales1'=>$materiales1,'dudas1'=>$dudas1,'control1'=>$control1,'interes1'=>$interes1,'actitud1'=>$actitud1,'experiencia2'=>$experiencia2,'planeacion2'=>$planeacion2,'puntualidad2'=>$puntualidad2,'materiales2'=>$materiales2,'dudas2'=>$dudas2,'control2'=>$control2,'interes2'=>$interes2,'actitud2'=>$actitud2,'experiencia3'=>$experiencia3,'planeacion3'=>$planeacion3,'puntualidad3'=>$puntualidad3,'materiales3'=>$materiales3,'dudas3'=>$dudas3,'control3'=>$control3,'interes3'=>$interes3,'actitud3'=>$actitud3,'mejor'=>$mejor,'sugerencias'=>$sugerencias,'catalogo'=>$catalogoCurso[0],'curso'=>$curso[0],'cursos'=>$cursos[0],'profesors'=>$profesors,'eval_id'=>$eval_id));	
		//return $pdf->download($envio.'.pdf');
	
		$profesoresCurso = ProfesoresCurso::where('curso_id',$curso_id)->get();
	
		$semestre = $curso[0]->semestre_anio;
	
		//Obtenemos los datos de los docentes/facilitadores y enviamos el correo
		$data = array(
			'name'=>"CDEval",
		);
	
		foreach($profesoresCurso as $profesorCurso){
			$profesor=Profesor::find($profesorCurso->profesor_id);
			Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf,$semestre){
				$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
				$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
				$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
			});
		}
	
	}

}

