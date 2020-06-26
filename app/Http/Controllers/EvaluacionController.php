<?php

/**
 * To Do list: Crear desde cero una html view para crear el formulario de la evaluacion final global (Formulas basadas en todo lo presente en la funcion que manda a llamar enviarCorreoFinal)
 * Ver que pedo con el tercer formulario
 * Se alteraron las tablas _evaluacion_x_seminario (agrego created_at y curso_id) y _evaluacion_final_seminario (agrego curso_id y constrint participante_curso, de igual forma se quito unique de participante_curso_id)
 */

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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use PDF;
use View;

ini_set('max_execution_time', '400');

class EvaluacionController extends Controller{


	public function index($profesor_id, $curso_id, $catalogoCurso_id){
 
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($curso->catalogo_id);
		$count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
		$infoCursos = array();
      
		foreach($participantesCurso as $participanteCurso){
            $curso = Curso::find($participanteCurso->curso_id);
			$catalogoCursos = CatalogoCurso::find($curso->catalogo_id);          
            $tupla = array();
                array_push($tupla,$curso);
                array_push($tupla,$catalogoCursos);
                array_push($infoCursos, $tupla);
		}

		$date = date("Y-m-j");
		
		//Se busca mandar a pages.evaluacionIndex las encuestas realizadas por el usuario para manejar los botones
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
		
		if(sizeof($evaluacion_x_curso) <= 0){
			$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
		}

		
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();

		if(sizeof($evaluacion_final_curso) <= 0){
			$participante = DB::table('participante_curso')
				->where([['curso_id',$curso_id],['profesor_id',$profesor_id]])
				->get();
			$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
				->select('_evaluacion_final_seminario.participante_curso_id')
				->where('participante_curso_id',$participante[0]->id)
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
			->with('final',$evaluacion_final_curso);
	  
	}
		
	/**
	 * @brief Funcion que retorna la ruta a admin.blade.php
	 */
	public function admin($profesor_id){
		$infoCursos=array(); 
        $profesor = Profesor::find($profesor_id);
        if ('admin' == $profesor->rfc && '1q2w3e4r' == $profesor->numTrabajador) {
            return view("pages.superadmin");
        }
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
        return view("pages.admin")
			->with("profesor",$profesor)
			->with('infoCursos',$infoCursos);
	}

	public function enviarCorreo($profesor_id, $curso_id, $catalogoCurso_id, $eval_curso, $lugar){
		$profesor = Profesor::find($profesor_id);
		$curso = CatalogoCurso::find($curso_id);
		$semestre=Curso::find($curso_id);
		$data = array(
			'name'=>"CDEval",
		);
		
		$pdf = PDF::loadView($lugar,array('curso' => $curso,'profesor'=>$profesor,'semestre'=>$semestre,'evaluacion'=>$eval_curso));	
		  
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
			foreach($profesoresCurso as $profesorCurso){
				$profesor=Profesor::find($profesorCurso->id);
				Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf,$semestre){
					$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
					$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
					$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
				});
			}
		}
	}

	public function enviarCorreoFinal($evals,$profesor_id,$curso_id, $catalogoCurso_id, $eval_fcurso,$participantes,$factor_acreditacion,$factor,$alumnos,$DP,$DH,$CO,$DI,$Otros,$ocupacion,$factor_respuestas_positivas,$factor_contenido,$factor_coordinacion,$lugar,$salon,$acreditado,$factor_instructor1,$minimo1,$maximo1,$factor_instructor2,$minimo2,$maximo2,$factor_instructor3,$minimo3,$maximo3, $numero_horas,$asistieron,$nombreInstructor){
		$profesor = Profesor::find($profesor_id);
		//$curso = CatalogoCurso::find($curso_id);
		$curso = DB::table('cursos')
			->where('id',$curso_id)
			->get();
		$semestre=Curso::find($curso_id);
		$data = array(
			'name'=>"CDEval",
		);
		
		$pdf = PDF::loadView($lugar,array('evals'=>$evals,'profesor_id'=>$profesor_id,'curso_id'=>$curso_id,'catalogoCurso_id'=>$catalogoCurso_id,'eval_fcurso'=>$eval_fcurso,'participantes'=>$participantes,'factor_acreditacion'=>$factor_acreditacion,'factor'=>$factor,'alumnos'=>$alumnos,'DP'=>$DP,'DH'=>$DH,'CO'=>$CO,'DI'=>$DI,'Otros'=>$Otros,'ocupacion'=>$ocupacion,'positivas'=>$factor_respuestas_positivas,'contenido'=>$factor_contenido,'factor_coordinacion'=>$factor_coordinacion, 'curso'=>$curso[0], 'salon'=>$salon[0], 'acreditaron'=>$acreditado, 'coordinaciones'=>array(),'instructor'=>$factor_instructor1,'minimo'=>$minimo1,'maximo'=>$maximo1,'instructor2'=>$factor_instructor2,'minimo2'=>$minimo2,'maximo2'=>$maximo2,'instructor3'=>$factor_instructor3,'minimo3'=>$minimo3,'maximo3'=>$maximo3, 'numero_horas'=>$numero_horas,'asistieron'=>$asistieron,'nombreInstructor'=>$nombreInstructor));	
          
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
			foreach($profesoresCurso as $profesorCurso){
				$profesor=Profesor::find($profesorCurso->id);
				Mail::send('pages.mensaje',$data, function ($message) use($profesor,$pdf,$semestre){
					$message->from(Array('cdevalresultados@gmail.com'=>'CDEval'));
					$message->to(Array($profesor->getCorreo()=>$profesor->getNombre()))->subject('Resultados de Encuesta');
					$message->attachData($pdf->output(), 'Resultados de Encuesta.pdf');
				});
			}
		}
	}

	public function evaluacionPorSesion($profesor_id, $curso_id, $catalogoCurso_id,$count){
		 
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
		$infoCursos = array();


		foreach($participantesCurso as $participanteCurso){
			$curso = Curso::find($participanteCurso->curso_id);
            $catalogoCursos = CatalogoCurso::find($curso->id);
                           
            $tupla = array();
            array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
            array_push($infoCursos, $tupla);
		}
            
		if($catalogoCurso->tipo == "Actualizacion"){
            return view("pages.xsesion_seminario")
				->with("profesor",$profesor)
				->with("curso",$curso)
                ->with('catalogoCurso',$catalogoCurso)
                ->with('infoCursos',$infoCursos);
                   
        }else{
            return view("pages.xsesion")
                ->with("profesor",$profesor)
                ->with("curso",$curso)
                ->with('catalogoCurso',$catalogoCurso)
                ->with('infoCursos',$infoCursos);
        }
               
    }

    public function evaluacionPorCurso($profesor_id, $curso_id, $catalogoCurso_id,$count){
 
		$profesor = Profesor::find($profesor_id);
		$curso = Curso::find($curso_id);
		$catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
		$infoCursos = array();
        
		foreach($participantesCurso as $participanteCurso){
            $curso = Curso::find($participanteCurso->curso_id);
			$catalogoCursos = CatalogoCurso::find($curso->id);
                           
			$tupla = array();
			array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
			array_push($infoCursos, $tupla);
		}
		if($catalogoCurso->tipo == "Actualizacion"){
			if($count==1){
                return view("pages.final_seminario_1")
					->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
			}elseif($count==2){
                return view("pages.final_seminario_2")
					->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
			}elseif($count==3){
                return view("pages.final_seminario_3")
                    ->with("profesor",$profesor)
                    ->with("curso",$curso)
                    ->with('catalogoCurso',$catalogoCurso)
                    ->with('infoCursos',$infoCursos);
			}      
		}else{
			if($count==1){
				return view("pages.final_curso_1")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos);
			}elseif($count==2){
				return view("pages.final_curso_2")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos);
			}elseif($count==3){
				return view("pages.final_curso_3")
					->with("profesor",$profesor)
					->with("curso",$curso)
					->with('catalogoCurso',$catalogoCurso)
					->with('infoCursos',$infoCursos);
			}          
		}         
		}
		//Guardar evaluaciones en la BD
	//Finales
	public function saveFinal_Curso(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
		$eval_fcurso = new EvaluacionFinalCurso;
		$correo = new EvaluacionController(); 
		$participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();
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
		$eval_fcurso->participante_curso_id = $profesor_id;
		$eval_fcurso->curso_id = $curso_id;
		$eval_fcurso->save();
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
	
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
		$infoCursos = array();
		
		foreach($participantesCurso as $participanteCurso){
			$curso = Curso::find($participanteCurso->curso_id);
			$catalogoCursos = CatalogoCurso::find($curso->id);
						
			$tupla = array();
			array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
            array_push($infoCursos, $tupla);
		}

		$this->enviarEvaluacionFinal($profesor_id,$curso_id,$catalogoCurso_id,$eval_fcurso,'pages.reporte_final_curso');

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
			->get();
	 
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su funcionamiento
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

     public function saveFinal_Seminario(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
          $eval_fseminario = new EvaluacionFinalSeminario;
          $promedio_p1 = new EvaluacionFinalSeminario;
		  
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();
		  $eval_fseminario->participante_curso_id=$profesor_id;
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
	
		$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
		$infoCursos = array();
		
		foreach($participantesCurso as $participanteCurso){
			$curso = Curso::find($participanteCurso->curso_id);
			$catalogoCursos = CatalogoCurso::find($curso->id);
						
			$tupla = array();
			array_push($tupla,$curso);
            array_push($tupla,$catalogoCursos);
            array_push($infoCursos, $tupla);
		}

		$this->enviarEvaluacionFinal($profesor_id,$curso_id,$catalogoCurso_id,$eval_fseminario,'pages.reporte_final_seminario');

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where('participante_curso_id',$profesor_id)
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
			->select('_evaluacion_final_seminario.participante_curso_id','_evaluacion_final_seminario.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();

		/*$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
			->select('_evaluacion_final_seminario.participante_curso_id')
			->where('participante_curso_id',$participante[0]->id)
			->get();*/
	 
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su funcionamiento
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
     
//Por sesiones
     public function saveXCurso(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
          $eval_xcurso = new EvaluacionXCurso;
          $correo = new EvaluacionController(); 
		  $participante = ParticipantesCurso::where([['profesor_id',$profesor_id],['curso_id',$curso_id]])->get('id');
		  $semestre=Curso::find($curso_id);
		  $participanteID = intval($participante[0]->id);
		  //Obtenemos la fecha actual para usarla en consultas posteriores	
		  $date = date("Y-m-j");
		  
		  //Guardamos en _evaluacion_x_curso todos los datos ingresados por el alumno en la encuesta

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
			$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
			$infoCursos = array();
      
			foreach($participantesCurso as $participanteCurso){
				$curso = Curso::find($participanteCurso->curso_id);
				$catalogoCursos = CatalogoCurso::find($curso->id);
                       
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
	
		$eval_curso = $eval_xcurso[0];

		//Enviamos el correo con los datos a usar
		$correo->enviarCorreo($profesor_id,$curso_id, $catalogoCurso_id, $eval_curso, 'pages.evaluacion_x_curso');
	 
		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su correcto funcionamiento
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

     public function saveXSeminario(Request $request,$profesor_id,$curso_id,$catalogoCurso_id){
          $eval_xseminario = new EvaluacionXSeminario;
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::where([['profesor_id',$profesor_id],['curso_id',$curso_id]])->get('id');
		  $semestre=Curso::find($curso_id);
		  $participanteID = $participante[0]->id;;
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
		  $eval_xseminario->curso_id=$curso_id;
		  
		  $date = date("Y-m-j");  

		  $eval_xseminario->created_at = $date;

          $eval_xseminario->save();
          $profesor = Profesor::find($profesor_id);
		  $curso = Curso::find($curso_id);
		  $catalogoCurso = CatalogoCurso::find($catalogoCurso_id);
		
		  $count = ProfesoresCurso::select($curso_id)
			->where('curso_id',$curso_id)
			->count();
			$participantesCurso = ParticipantesCurso::where('profesor_id',$profesor->id)->get();
			$infoCursos = array();
      
			foreach($participantesCurso as $participanteCurso){
				$curso = Curso::find($participanteCurso->curso_id);
				$catalogoCursos = CatalogoCurso::find($curso->id);
                       
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

		$eval_curso = $eval_xcurso[0];
	  
		//Enviamos el correo con los datos a usar
		//$correo->enviarCorreo($profesor_id,$curso_id, $catalogoCurso_id, $eval_curso, 'pages.evaluacion_x_seminario');
	 
		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_seminario')
			->select('_evaluacion_x_seminario.created_at','_evaluacion_x_seminario.curso_id')
			->where([['created_at',$date],['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
		

		$evaluacion_final_curso = DB::table('_evaluacion_final_seminario')
			->select('_evaluacion_final_seminario.participante_curso_id','_evaluacion_final_seminario.curso_id')
			->where([['curso_id',$curso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		//Retornamos la vista pages.evaluacionIndex con los datos necesarios para su correcto funcionamiento
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
	
	public function enviarClaveCrusoHistorico(Request $request, $profesor_id){
		
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
			$curso = DB::table('catalogo_cursos')
				->select('nombre_curso','duracion_curso','clave_curso','tipo')
				->where('id',$cursosParticipante->curso_id)
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
	
	public function enviarClaveFecha(Request $request, $profesor_id){
		//Obtenemos el semestre aceptado por el usuario y lo dividimos entre -
		$semestre = $request->get('semestre');
		$fecha_semestre = explode('-',$semestre);
		
		//Obtenemos los cursos en los que ha estado inscrito el profesor
		$cursos_tomados=DB::table('participante_curso')
			->select('*')
			->where('profesor_id',$profesor_id)
			->get();
			
		$cursos=array();
			
		//Iteramos los cursos y obtenemos su informacion
		foreach($cursos_tomados as $curso){
			$catalogo=DB::table('catalogo_cursos')
				->select('nombre_curso','duracion_curso','clave_curso','tipo')
				->where('id',$curso->curso_id)
				->get();
			
			$curso_lista=DB::table('cursos')
				->select('*')
				->where('id',$curso->curso_id)
				->get();
			
			//Si el curso corresponde al semestre ingresado por el profesor entonces lo guardamos en la lista
			if($curso_lista[0]->semestre_anio==$fecha_semestre[0] && $curso_lista[0]->semestre_pi==$fecha_semestre[1]){
				array_push($cursos,$catalogo);
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
		
		//Obtenemos los cursos en donde ha participado el profesor
		$infoCursos=array(); 
		$cursos=array();
		
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
		
		//Retornamos la vista pages.admin con los datos necesarios para su funcionamiento
		return View::make('pages.admin')
			->with('profesor',$profesor)
			->with('infoCursos',$infoCursos)
			->with('msj','Claves enviadas');
			
	}

	public function enviarEvaluacionFinal($profesor_id, $curso_id, $catalogoCurso_id, $eval_fcurso, $lugar){
		$correo = new EvaluacionController(); 
		$evals = 0;

		//Checamos si el usuario desea los reportes de los cursos o de los seminarios
		if(strcmp($lugar,'pages.reporte_final_curso') == 0){
			$evals = DB::table('_evaluacion_final_curso')
			->where("curso_id",$curso_id)
			->get();

		}else{
			$evals = DB::table('_evaluacion_final_seminario')
			->where("curso_id",$curso_id)
			->get();
		}

		//Obtenemos el id de los instructores de los cursos
		$instructores = DB::table('profesor_curso')
			->where('curso_id',$evals[0]->curso_id)
			->get();

		//Obtenemos los datos de los instructores de cada curso
		$nombreInstructor = array();
		foreach($instructores as $instructorCurso){
			$instructor = DB::table('profesors')
				->where('id',$instructorCurso->profesor_id)
				->get();
			array_push($nombreInstructor,$instructor[0]);
		}

		//Obtenemos el cupo maximo del curso en cuestion
		$curso_ocupacion = DB::table("cursos")
			->where("id",$curso_id)
			->value("cupo_maximo");

		//Obtenemos los participantes del curso
		$participantes = DB::table('participante_curso')
			->where('curso_id',$curso_id)
			->get();

		//Obtenemos el curso?
		$curso = DB::table('cursos')
			->where('id',$curso_id)
			->get();

		//Obtenemos los datos del curso
		$catalogo_curso = DB::table('catalogo_cursos')
			->where('id',$curso[0]->catalogo_id)
			->get();

		//Obtenemos el salon donde se imparte el curso
		$salon = DB::table('salons')
			->where('id',$curso[0]->salon_id)
			->get();

		//Obtenemos el factor de recomendación y de asistencia
		$recomendaciones = 0;
        $factor = 0;
		$alumnos = 0;

        foreach($evals as $array){
			//Si la pregunta 7 vale uno es curso es recomendado
            if($array->p7 == 1){
                $recomendaciones = $recomendaciones + 1;
                $alumnos = $alumnos + 1;
            }else if($array->p7 == 0){
                $alumnos = $alumnos + 1;
            }
		}
		
		//Obtenemos el factor de recomendacion
        if($alumnos == 0){
            $factor = round(($recomendaciones * 100) / 1,2);
        }else
        {
            $factor = round(($recomendaciones * 100) / $alumnos,2);
		}

		//Obtenemos el factor de acreditación y la asistencia
		$acreditado = 0;
		$factor_acreditacion = 0;
		$alumnos = 0;
		$asistieron = 0;
		foreach($participantes as $participante){
			$alumnos = $alumnos + 1;
			if($participante->acreditacion == 1){
				$acreditado = $acreditado + 1;
			}
			if($participante->asistencia == 1){
				$asistieron++;
			}
		}

		//Obtenemos el factor de acreditacion 
		if($alumnos == 0){
			$factor_acreditacion = round(($acreditado * 100) / 1,2);
		}else
		{
			$factor_acreditacion = round(($acreditado * 100) / $alumnos,2);
		}

		//Obtenemos el factor de ocupacion
		$ocupacion = ($alumnos*100)/$curso_ocupacion;

		//Obtenemos la cantidad de integrantes de cada area
		$DP=0;
        $DH=0;
        $CO=0;
        $DI=0;
        $Otros=0;
        foreach($evals as $evaluacion){
            $array = explode(',',$evaluacion->conocimiento);
            foreach($array as $elem){
                if($elem[2] == 1 || $elem[1] == 1){
					//Aumentamos numero integrante Division Pedagogia
					$DP++;
                }else if($elem[2] == 2 || $elem[1] == 2){
					//Aumentamos numero integrantes division desarrollo humano
                    $DH++;
                }else if($elem[2] == 3 || $elem[1] == 3){
					//Aumentamos numero integrante Division de computo
                    $CO++;
                }else if($elem[2] == 4 || $elem[1] == 4){
					//Aumentamos numero integrante Division de disciplina
                    $DI++;
                }else if($elem[2] == 5 || $elem[1] == 5){
					//Aumentamos numero integrante externo
                    $Otros++;
                }
            }
		}
		
		$preguntas = 0;
		$positivas = 0;
		$respuestasContenido = 0;
		$respuestasCoordinacion = 0;
		$respuestasInstructores1 = 0;
		$respuestasInstructores2 = 0;
		$respuestasInstructores3 = 0;
		$alumnos = 0;
		$alumnos_eval_instructor1 = 0;
		$alumnos_eval_instructor2 = 0;
		$alumnos_eval_instructor3 = 0;
		$promedios1 = array();
		$promedios2 = array();
		$promedios3 = array();
		$respuesta_individual1 = 0;
		$respuesta_individual2 = 0;
		$respuesta_individual3 = 0;

		//Bucle necesario para obtener el numero de preguntas positivas, evaluaciones de cada uno de los instructores y los factores de calidad de contenido, de calidad de la coordinacion, y los factores de calidad de los instructores
		foreach($evals as $evaluacion){
			//Aumentamos el numero de alumnos que respondieron el cuestionario
			$alumnos++;
			//Desde 1_1 a 1_5 obtenemos el factor de calidad del contenido ($respuestasContenido/$alumnos*5) valor >= 60
			if($evaluacion->p1_1 >= 20){
				$preguntas++;
				$respuestasContenido += $evaluacion->p1_1;
				if($evaluacion->p1_1 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p1_2 >= 20){
				$preguntas++;
				$respuestasContenido+= $evaluacion->p1_2;
				if($evaluacion->p1_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p1_3 >= 20){
				$preguntas++;
				$respuestasContenido+= $evaluacion->p1_3;
				if($evaluacion->p1_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p1_4 >= 20){
				$preguntas++;
				$respuestasContenido+= $evaluacion->p1_4;
				if($evaluacion->p1_4 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p1_5 >= 20){
				$preguntas++;
				$respuestasContenido+= $evaluacion->p1_5;
				if($evaluacion->p1_5 >= 60){
					$positivas++;
				}
			}

			if($evaluacion->p2_1 >= 20){
				$preguntas++;
				if($evaluacion->p2_1 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p2_2 >= 20){
				$preguntas++;
				if($evaluacion->p2_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p2_3 >= 20){
				$preguntas++;
				if($evaluacion->p2_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p2_4 >= 20){
				$preguntas++;
				if($evaluacion->p2_4 >= 60){
					$positivas++;
				}
			}

			//Desde 1_1 a 1_5 obtenemos el factor de calidad de la coordinacion ($respuestasCoordinacion/$alumnos*4)
			if($evaluacion->p3_1 >= 20){
				$preguntas++;
				$respuestasCoordinacion += $evaluacion->p3_1;
				if($evaluacion->p3_1 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p3_2 >= 20){
				$preguntas++;
				$respuestasCoordinacion += $evaluacion->p3_2;
				if($evaluacion->p3_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p3_3 >= 20){
				$preguntas++;
				$respuestasCoordinacion += $evaluacion->p3_3;
				if($evaluacion->p3_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p3_4 >= 20){
				$preguntas++;
				$respuestasCoordinacion += $evaluacion->p3_4;
				if($evaluacion->p3_4 >= 60){
					$positivas++;
				}
			}

			//Las preguntas correspondientes al primer instructor
			if($evaluacion->p4_1 >= 20){
				$alumnos_eval_instructor1++;
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_1;
				$respuesta_individual1+= $evaluacion->p4_1;
				if($evaluacion->p4_1 == 1){
					$positivas++;
				}
			}
			if($evaluacion->p4_2 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_2;
				$respuesta_individual1+= $evaluacion->p4_2;
				if($evaluacion->p4_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_3 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_3;
				$respuesta_individual1+= $evaluacion->p4_3;
				if($evaluacion->p4_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_4 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_4;
				$respuesta_individual1+= $evaluacion->p4_4;
				if($evaluacion->p4_4 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_5 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_5;
				$respuesta_individual1+= $evaluacion->p4_5;
				if($evaluacion->p4_5 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_6 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_6;
				$respuesta_individual1+= $evaluacion->p4_6;
				if($evaluacion->p4_6 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_7 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_7;
				$respuesta_individual1+= $evaluacion->p4_7;
				if($evaluacion->p4_7 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_8 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_8;
				$respuesta_individual1+= $evaluacion->p4_8;
				if($evaluacion->p4_8 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_9 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_9;
				$respuesta_individual1+= $evaluacion->p4_9;
				if($evaluacion->p4_9 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p4_10 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_10;
				$respuesta_individual1+= $evaluacion->p4_10;
				if($evaluacion->p4_10 >= 60){
					$positivas++;
				}
			}
			//Queremos obtener todas las evaluaciones para luego comparar promedio, minimo y maximo del instructor
			if($evaluacion->p4_11 >= 20){
				$preguntas++;
				$respuestasInstructores1+= $evaluacion->p4_11;
				$respuesta_individual1+= $evaluacion->p4_11;
				array_push($promedios1, round($respuesta_individual1/11,2));
				$respuesta_individual1 = 0;
				if($evaluacion->p4_11 >= 60){
					$positivas++;
				}
			}

			//Las preguntas correspondientes al segundo instructor
			if($evaluacion->p5_1 >= 20){
				$alumnos_eval_instructor2++;
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_1;
				$respuesta_individual2+= $evaluacion->p5_1;
				if($evaluacion->p5_1 == 1){
					$positivas++;
				}
			}
			if($evaluacion->p5_2 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_2;
				$respuesta_individual2+= $evaluacion->p5_2;
				if($evaluacion->p5_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_3 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_3;
				$respuesta_individual2+= $evaluacion->p5_3;
				if($evaluacion->p5_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_4 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_4;
				$respuesta_individual2+= $evaluacion->p5_4;
				if($evaluacion->p5_4 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_5 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_5;
				$respuesta_individual2+= $evaluacion->p5_5;
				if($evaluacion->p5_5 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_6 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_6;
				$respuesta_individual2+= $evaluacion->p5_6;
				if($evaluacion->p5_6 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_7 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_7;
				$respuesta_individual2+= $evaluacion->p5_7;
				if($evaluacion->p5_7 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_8 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_8;
				$respuesta_individual2+= $evaluacion->p5_8;
				if($evaluacion->p5_8 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_9 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_9;
				$respuesta_individual2+= $evaluacion->p5_9;
				if($evaluacion->p5_9 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p5_10 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_10;
				$respuesta_individual2+= $evaluacion->p5_10;
				if($evaluacion->p5_10 >= 60){
					$positivas++;
				}
			}
			//Queremos obtener todas las evaluaciones para luego comparar promedio, minimo y maximo del instructor
			if($evaluacion->p5_11 >= 20){
				$preguntas++;
				$respuestasInstructores2+= $evaluacion->p5_11;
				$respuesta_individual2+= $evaluacion->p5_11;
				array_push($promedios2, round($respuesta_individual2/11,2));
				$respuesta_individual2 = 0;
				if($evaluacion->p5_11 >= 60){
					$positivas++;
				}
			}
			
			//Las preguntas correspondientes al tercer instructor
			if($evaluacion->p6_1 >= 20){
				$alumnos_eval_instructor3++;
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_1;
				$respuesta_individual3+= $evaluacion->p6_1;
				if($evaluacion->p6_1 == 1){
					$positivas++;
				}
			}
			if($evaluacion->p6_2 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_2;
				$respuesta_individual3+= $evaluacion->p6_2;
				if($evaluacion->p6_2 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_3 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_3;
				$respuesta_individual3+= $evaluacion->p6_3;
				if($evaluacion->p6_3 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_4 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_4;
				$respuesta_individual3+= $evaluacion->p6_4;
				if($evaluacion->p6_4 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_5 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_5;
				$respuesta_individual3+= $evaluacion->p6_5;
				if($evaluacion->p6_5 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_6 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_6;
				$respuesta_individual3+= $evaluacion->p6_6;
				if($evaluacion->p6_6 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_7 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_7;
				$respuesta_individual3+= $evaluacion->p6_7;
				if($evaluacion->p6_7 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_8 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_8;
				$respuesta_individual3+= $evaluacion->p6_8;
				if($evaluacion->p6_8 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_9 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_9;
				$respuesta_individual3+= $evaluacion->p6_9;
				if($evaluacion->p6_9 >= 60){
					$positivas++;
				}
			}
			if($evaluacion->p6_10 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_10;
				$respuesta_individual3+= $evaluacion->p6_10;
				if($evaluacion->p6_10 >= 60){
					$positivas++;
				}
			}

			//Queremos obtener todas las evaluaciones para luego comparar promedio, minimo y maximo del instructor
			if($evaluacion->p6_11 >= 20){
				$preguntas++;
				$respuestasInstructores3+= $evaluacion->p6_11;
				$respuesta_individual3+= $evaluacion->p6_11;
				array_push($promedios3, round($respuesta_individual3/11,2));
				$respuesta_individual3 = 0;
				if($evaluacion->p6_11 >= 60){
					$positivas++;
				}
			}

		}

		//Obtenemos la evaluacion minima y maxima del primer instructor
		$minimo1 = 0;
		$maximo1 = 0;

		foreach($promedios1 as $promedio){
			if($minimo1 == 0){
				$minimo1 = $promedio;
			}
			if($promedio < $minimo1){
				$minimo1 = $promedio;
			}
			if($promedio > $maximo1){
				$maximo1 = $promedio;
			}
		}

		//Obtenemos la evaluacion minima y maxima del segundo instructor
		$minimo2 = 0;
		$maximo2 = 0;

		foreach($promedios2 as $promedio){
			if($minimo2 == 0){
				$minimo2 = $promedio;
			}
			if($promedio < $minimo2){
				$minimo2 = $promedio;
			}
			if($promedio > $maximo2){
				$maximo2 = $promedio;
			}
		}

		//Obtenemos la evaluacion minima y maxima del tercer instructor
		$minimo3 = 0;
		$maximo3 = 0;

		foreach($promedios3 as $promedio){
			if($minimo3 == 0){
				$minimo3 = $promedio;
			}
			if($promedio < $minimo3){
				$minimo3 = $promedio;
			}
			if($promedio > $maximo3){
				$maximo3 = $promedio;
			}
		}

		//Checamos el numero de instructores del curso para ver a cual de los view enviar
		$envio = 0;
		if(strcmp($lugar,'pages.reporte_final_seminario')==0){
			if($minimo3 != 0){
				$envio = 'pages.reporte_final_seminario3';
			}else if($minimo2 != 0){
				$envio = 'pages.reporte_final_seminario2';
			}else{
				$envio = 'pages.reporte_final_seminario1';
			}
		}else{
			if($minimo3 != 0){
				$envio = 'pages.reporte_final_curso3';
			}else if($minimo2 != 0){
				$envio = 'pages.reporte_final_curso2';
			}else{
				$envio = 'pages.reporte_final_curso1';
			}
		}

		//En caso de no haber alumnos ni preguntas (se pide el resumen de un curso no evaluado anteriormente) pasamos su valor a 1 para evitar division by zero exception
		if($alumnos == 0){
			$alumnos = 1;
		}
		
		if($preguntas == 0){
			$preguntas = 1;
		}

		$factor_instructor1 = 0;

		//Si hay un instructor obtenemos su factor
		if($alumnos_eval_instructor1 != 0){
			$factor_instructor1 = round($respuestasInstructores1 / ($alumnos_eval_instructor1*11),2);
		}

		$factor_instructor2 = 0;

		//Si hay dos instructores obtenemos su factor
		if($alumnos_eval_instructor2 != 0){
			$factor_instructor2 = round($respuestasInstructores2 / ($alumnos_eval_instructor2*11),2);
		}

		$factor_instructor3 = 0;

		//Si hay tres instructores obtenemos su factor
		if($alumnos_eval_instructor3 != 0){
			$factor_instructor3 = round($respuestasInstructores3 / ($alumnos_eval_instructor3*11),2);
		}

		//Obtenemos los factores de respuestas positivas, contenido y coordinacion
		$factor_respuestas_positivas = round($positivas*100 / $preguntas, 2);
		$factor_contenido = round($respuestasContenido / ($alumnos*5),2);
		$factor_coordinacion = round($respuestasCoordinacion / ($alumnos*4),2);

		//Obtenemos el numero de horas a partir del numero de sesiones y las horas de cada sesion
		$horas_inicio = explode(':',$curso[0]->hora_inicio);
		$horas_fin = explode(':',$curso[0]->hora_fin);

		$inicio = intval($horas_inicio[0]) + floatval($horas_inicio[1]/100);
		$fin = intval($horas_fin[0]) + floatval($horas_fin[1]/100);

		$numero_horas = floatval($curso[0]->numero_sesiones) * ($fin-$inicio);

		$profesores = array();


		//Mandamos el correo
		$correo->enviarCorreoFinal($evals,$profesor_id,$curso_id, $catalogoCurso_id, $eval_fcurso,$participantes,$factor_acreditacion,$factor,$alumnos,$DP,$DH,$CO,$DI,$Otros,$ocupacion,$factor_respuestas_positivas,$factor_contenido,$factor_coordinacion,$envio,$salon,$acreditado,$factor_instructor1,$minimo1,$maximo1,$factor_instructor2,$minimo2,$maximo2,$factor_instructor3,$minimo3,$maximo3,$numero_horas,$asistieron,$nombreInstructor);

	}
       
}
