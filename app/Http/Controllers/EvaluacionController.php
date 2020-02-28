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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use PDF;
use View;
class EvaluacionController extends Controller{


    public function index($profesor_id, $curso_id, $catalogoCurso_id){
 
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
	 
		$date = date("Y-m-j");
		
		//Se busca mandar a pages.evaluacionIndex las encuestas realizadas por el usuario para manejar los botones
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
			->get();
	 
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
		
     
	public function enviarCorreo($profesor_id, $curso_id, $catalogoCurso_id, $eval_curso, $lugar){
		$profesor = Profesor::find($profesor_id);
		$curso = CatalogoCurso::find($curso_id);
		$semestre=Curso::find($curso_id);
		$data = array(
			'name'=>"CDEval",
		);
		
		$pdf = PDF::loadView($lugar,array('curso' => $curso,'profesor'=>$profesor,'semestre'=>$semestre,'evaluacion'=>$eval_curso));	
          
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
		$eval_fcurso->curso_id = $catalogoCurso_id;
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
		

		//Enviamos el correo con los datos a usar
		$correo->enviarCorreo($profesor_id,$curso_id, $catalogoCurso_id, $eval_fcurso, 'pages.validacion');

		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
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
          
          $participante = ParticipantesCurso::find($profesor_id);
          $eval_fseminario->participante_curso_id=$participante->id;
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::where('profesor_id',$profesor_id)->where('curso_id',$curso_id)->get();
          $eval_fseminario->participante_curso_id=$participante[0]->id;
          
          
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

          return redirect()->back()
          ->with('msj', 'Evaluación enviada');
     }
     
//Por sesiones
     public function saveXCurso(Request $request,$profesor_id,$curso_id, $catalogoCurso_id){
          $eval_xcurso = new EvaluacionXCurso;
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::find($profesor_id);
		  $semestre=Curso::find($curso_id);
		  
		  //Obtenemos la fecha actual para usarla en consultas posteriores	
		  $date = date("Y-m-j");
		  
		  //Guardamos en _evaluacion_x_curso todos los datos ingresados por el alumno en la encuesta
          $eval_xcurso->participante_curso_id=$participante->id;
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
		  $eval_xcurso->curso_id=$catalogoCurso_id;
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
			->where([['created_at',$date],['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
			->get();
	  
		//Enviamos el correo con los datos a usar
		$correo->enviarCorreo($profesor_id,$curso_id, $catalogoCurso_id, $eval_xcurso, 'pages.evaluacion_x_curso');
	 
		//Revisamos si hay encuestas realizadas por el alumno en el día actual
		$evaluacion_x_curso = DB::table('_evaluacion_x_curso')
			->select('_evaluacion_x_curso.created_at','_evaluacion_x_curso.curso_id')
			->where([['created_at',$date],['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
			->get();
			
		$evaluacion_final_curso = DB::table('_evaluacion_final_curso')
			->select('_evaluacion_final_curso.participante_curso_id','_evaluacion_final_curso.curso_id')
			->where([['curso_id',$catalogoCurso_id],['participante_curso_id',$profesor_id]])
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

     public function saveXSeminario(Request $request,$profesor_id,$curso_id){
          $eval_xseminario = new EvaluacionXSeminario;
          $correo = new EvaluacionController(); 
          $participante = ParticipantesCurso::find($profesor_id);
          $eval_xseminario->participante_curso_id=$participante->id;
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
          $eval_xseminario->save();
          $correo->enviarCorreo($profesor_id,$curso_id);
          return redirect()->back()
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
			->with('success','Correo enviado');
		
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
		
		//Redireccionamoes a la pagina de selección de semestre
		return View::make('pages.enviar_por_fecha')
			->with('profesor',$profesor)
			->with('infoCursos',$infoCursos);
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
			->with('success','Correo enviado');
			
	}
       
}
