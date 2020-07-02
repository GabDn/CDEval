<?php

use Illuminate\Database\Seeder;

class DatosPrueba extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //1_RespuestasEvalCursosTodasAreas_2020-1s_4.pdf

		DB::table('coordinacions')->insert([
			'id'=>50,
			'abreviatura'=>'AC',
			'nombre_coordinacion'=>'Área de cómputo',
			'coordinador'=>'Gerardo Lopez Gomez',
			'grado'=>'M.C.C',
			'usuario'=>'G3rardo1nEZ',
			'password'=>'$10$Sli0p2.SdjP7JTbyze.RIucCUJA5MOG6AEB40sJG3Ok3Kb33ltibl'
		]);
		
		DB::table('catalogo_cursos')->insert([
			'id'=> 50,
			'nombre_curso'=>'Tecnologías de la Información y la Comunicación (TIC). Parte 1',
			'duracion_curso' => '20',
            'coordinacion_id' => 50,
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>50,
			'clave_curso'=>'TICDGAPA'
		]);
		
		DB::table('cursos')->insert([
			'id'=>50,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 50,
            'salon_id' => 1
			
		]);
        
        DB::table('profesors')->insert([
            'id'=>92,
			'nombres'=>'Gabriel',
			'apellido_paterno'=>'Lopez',
			'apellido_materno'=>'Dominguez',
			'rfc'=>'LODG720202LODG',
			'numero_trabajador' => '121432492',
			'fecha_nacimiento'=>'1972-02-02'
        ]);

		DB::table('profesor_curso')->insert([
			'id'=>50,
			'curso_id'=>50,
			'profesor_id'=>92,
        ]);
        
        DB::table('profesors')->insert([
            'id'=>93,
			'nombres'=>'Guillermo Adolfo',
			'apellido_paterno'=>'Vignau',
			'apellido_materno'=>'Esteva',
			'rfc'=>'VIEG720203VIEG',
			'numero_trabajador' => '121432493',
			'fecha_nacimiento'=>'1972-02-03'
        ]);

		DB::table('profesor_curso')->insert([
			'id'=>51,
			'curso_id'=>50,
			'profesor_id'=>93,
		]);
		
		DB::table('profesors')->insert([
			'id'=>50,
			'nombres'=>'Voileta Erendira',
			'apellido_paterno'=>'Escalante',
			'apellido_materno'=>'Estrada',
			'rfc'=>'EEEV720102EEE',
			'numero_trabajador' => '121432450',
			'fecha_nacimiento'=>'1972-01-02'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>50,
			'curso_id'=>50,
			'profesor_id'=>50,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'El conocimiento de nuevas herramientas',
			'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'80',
			'p4_10'=>'100',
			'p4_11'=>'80',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'80',
			'p5_10'=>'100',
            'p5_11'=>'80',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>50
		]);
		
		DB::table('profesors')->insert([
			'id'=>51,
			'nombres'=>'Jose',
			'apellido_paterno'=>'Gonzalez',
			'apellido_materno'=>'Suarez',
			'rfc'=>'GOSJ720103GOSJ',
			'numero_trabajador' => '121432451',
			'fecha_nacimiento'=>'1972-01-03'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>51,
			'curso_id'=>50,
			'profesor_id'=>51,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'60',
			'p2_1'=>'80',
			'p2_2'=>'60',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Todo porque me pareció muye buano y que lo puedo aplicar en las clases',
			'sug'=>'Me pareció bueno así tal y como se impartió',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>51
		]);
		
		DB::table('profesors')->insert([
			'id'=>52,
			'nombres'=>'Patricia',
			'apellido_paterno'=>'Gonzalez',
			'apellido_materno'=>'Vega',
			'rfc'=>'GOPV720104GOPV',
			'numero_trabajador' => '121432452',
			'fecha_nacimiento'=>'1972-01-04'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>52,
			'curso_id'=>50,
			'profesor_id'=>52,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'40',
			'p2_3'=>'80',
			'p2_4'=>'100',
			'p3_1'=>'40',
			'p3_2'=>'100',
			'p3_3'=>'60',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Plataformas educativas',
			'sug'=>'Sigan dando esto cursos',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>52
		]);
		
		DB::table('profesors')->insert([
			'id'=>53,
			'nombres'=>'Gudelia',
			'apellido_paterno'=>'Hernandez',
			'apellido_materno'=>'Molina',
			'rfc'=>'HEMG720105HEMG',
			'numero_trabajador' => '121432453',
			'fecha_nacimiento'=>'1972-01-05'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>53,
			'curso_id'=>50,
			'profesor_id'=>53,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'80',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Todo me gusto porque es nuevo para mí y ayuda a construir un curso desde otra perspectiva',
			'sug'=>'Me ha gustado mucho todo lo visto y creo que me será de utilidad en mis clases',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>53
		]);
		
		DB::table('profesors')->insert([
			'id'=>54,
			'nombres'=>'Jose Gerardo',
			'apellido_paterno'=>'Lopez',
			'apellido_materno'=>'Bonifacio',
			'rfc'=>'LOBJ720106LOBJ',
			'numero_trabajador' => '121432454',
			'fecha_nacimiento'=>'1972-01-06'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>54,
			'curso_id'=>50,
			'profesor_id'=>54,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Los temas tratados y la calidad humana por parte de los doscentes',
			'sug'=>'El temario está muy bien de hecho, si acaso dar un día más de clases a manera personal, aunque se abarcaron muy bien los temas, sobre todo para más',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>54
		]);
		
		DB::table('profesors')->insert([
			'id'=>55,
			'nombres'=>'Martin',
			'apellido_paterno'=>'Mejia',
			'apellido_materno'=>'Ramos',
			'rfc'=>'MERM720107MERM',
			'numero_trabajador' => '121432455',
			'fecha_nacimiento'=>'1972-01-07'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>55,
			'curso_id'=>50,
			'profesor_id'=>55,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'80',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Gaceta"]',
			'mejor'=>'El trato con los profesores',
			'sug'=>'Que no esté tan cargado porque no se profundiza',
			'p4_1'=>'80',
			'p4_2'=>'80',
			'p4_3'=>'80',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'80',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>55
		]);
		
		DB::table('profesors')->insert([
			'id'=>56,
			'nombres'=>'Javier',
			'apellido_paterno'=>'Millan',
			'apellido_materno'=>'Martinez',
			'rfc'=>'MIMJ720108MIMJ',
			'numero_trabajador' => '121432456',
			'fecha_nacimiento'=>'1972-01-08'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>56,
			'curso_id'=>50,
			'profesor_id'=>56,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'La disposición',
			'sug'=>'5mentarios',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>56
		]);
		
		DB::table('profesors')->insert([
			'id'=>57,
			'nombres'=>'Eduardo',
			'apellido_paterno'=>'Rosas',
			'apellido_materno'=>'Lira',
			'rfc'=>'ROLE720109ROLE',
			'numero_trabajador' => '121432457',
			'fecha_nacimiento'=>'1972-01-09'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>57,
			'curso_id'=>50,
			'profesor_id'=>57,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El uso de las TIC para las asignaturas',
			'sug'=>'Debería haber dos sesiones a la semana',
			'p4_1'=>'80',
			'p4_2'=>'100',
			'p4_3'=>'80',
			'p4_4'=>'100',
			'p4_5'=>'80',
			'p4_6'=>'80',
			'p4_7'=>'80',
			'p4_8'=>'80',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'80',
			'p5_1'=>'80',
			'p5_2'=>'80',
			'p5_3'=>'100',
			'p5_4'=>'80',
			'p5_5'=>'80',
			'p5_6'=>'80',
			'p5_7'=>'80',
			'p5_8'=>'80',
			'p5_9'=>'80',
			'p5_10'=>'80',
            'p5_11'=>'80',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>57
		]);
		
		DB::table('profesors')->insert([
			'id'=>58,
			'nombres'=>'Agustin Gerardo',
			'apellido_paterno'=>'Ruiz',
			'apellido_materno'=>'Tamayo',
			'rfc'=>'RUTA720111RUTA',
			'numero_trabajador' => '121432458',
			'fecha_nacimiento'=>'1972-01-11'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>58,
			'curso_id'=>50,
			'profesor_id'=>58,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","DGAPA"]',
			'mejor'=>'Ver herramientas alternas para trabajar con los alumnos',
			'sug'=>'Tal vez, un poco más de tiempo, que sean al menos unas 30 horas el curso',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>58
		]);
		
		
		DB::table('profesors')->insert([
			'id'=>59,
			'nombres'=>'Jaime Juan',
			'apellido_paterno'=>'Zarza y',
			'apellido_materno'=>'Teran',
			'rfc'=>'ZATJ720112ZATJ',
			'numero_trabajador' => '121432459',
			'fecha_nacimiento'=>'1972-01-12'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>59,
			'curso_id'=>50,
			'profesor_id'=>59,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Conocimiento acerca de nuevas herramientas',
			'sug'=>'Dar continuidad con otros cursos',
			'p4_1'=>'80',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'80',
			'p4_5'=>'100',
			'p4_6'=>'80',
			'p4_7'=>'80',
			'p4_8'=>'100',
			'p4_9'=>'80',
			'p4_10'=>'80',
			'p4_11'=>'100',
			'p5_1'=>'100',
			'p5_2'=>'80',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'80',
			'p5_6'=>'80',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>50,
			'participante_curso_id'=>59
        ]);
        
		//1_RespuestasEvalCursosTodasAreas_2020-1s_33.pdf
		
		DB::table('catalogo_cursos')->insert([
			'id'=> 51,
			'nombre_curso'=>'Módulo 4. Tendencias y estrategias de comunicación para la docencia',
			'duracion_curso' => '20',
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>1,
			'clave_curso'=>'TECDDGAPA'
		]);
		
		DB::table('cursos')->insert([
			'id'=>51,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 51,
            'salon_id' => 2
			
        ]);
        
        DB::table('profesors')->insert([
            'id'=>94,
			'nombres'=>'Claudia',
			'apellido_paterno'=>'Loreto',
			'apellido_materno'=>'Miranda',
			'rfc'=>'LOMC720204LOMC',
			'numero_trabajador' => '121432494',
			'fecha_nacimiento'=>'1972-02-04'
        ]);
		
		DB::table('profesor_curso')->insert([
			'id'=>52,
			'curso_id'=>51,
			'profesor_id'=>94,
        ]);
        
		DB::table('profesors')->insert([
			'id'=>60,
			'nombres'=>'Ana Yantzin',
			'apellido_paterno'=>'Almanza',
			'apellido_materno'=>'Valdez',
			'rfc'=>'ALVA720112ALVA',
			'numero_trabajador' => '121432460',
			'fecha_nacimiento'=>'1972-01-13'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>60,
			'curso_id'=>51,
			'profesor_id'=>60,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["4","Profesor"]',
			'mejor'=>'Las técnicas que se nos mostró para mejorar nuestras habilidades de enseñanza',
			'sug'=>'Variedad de cursos',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>60
        ]);
        
		DB::table('profesors')->insert([
			'id'=>61,
			'nombres'=>'Angel Francisco',
			'apellido_paterno'=>'Alvarez',
			'apellido_materno'=>'Herrera',
			'rfc'=>'ALHA720114ALHA',
			'numero_trabajador' => '121432461',
			'fecha_nacimiento'=>'1972-01-14'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>61,
			'curso_id'=>51,
			'profesor_id'=>61,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Los contenidos desarrollados y la uinmediata aplicación',
            'sug'=>'Gracias',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>61
        ]);

        
		DB::table('profesors')->insert([
			'id'=>62,
			'nombres'=>'Gaspar',
			'apellido_paterno'=>'Franco',
			'apellido_materno'=>'Hernandez',
			'rfc'=>'FAHG720115FAHG',
			'numero_trabajador' => '121432462',
			'fecha_nacimiento'=>'1972-01-15'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>62,
			'curso_id'=>51,
			'profesor_id'=>62,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'La forma en que la instructora presentó los temas aterrizados a la realidad',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'Otro',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>62
        ]);

        DB::table('profesors')->insert([
			'id'=>63,
			'nombres'=>'Luis Antonio',
			'apellido_paterno'=>'Garcia',
			'apellido_materno'=>'Villanueva',
			'rfc'=>'GAVL720116GAVL',
			'numero_trabajador' => '121432463',
			'fecha_nacimiento'=>'1972-01-16'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>63,
			'curso_id'=>51,
			'profesor_id'=>63,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'La estrategia de enseñanza-aprendizaje denominado aula invertida',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["4"]',
			'tematica'=>'Varias',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>63
        ]);

        DB::table('profesors')->insert([
			'id'=>64,
			'nombres'=>'Griselda Berenica',
			'apellido_paterno'=>'Hernandez',
			'apellido_materno'=>'Cruz',
			'rfc'=>'HERC720117HERCV',
			'numero_trabajador' => '121432464',
			'fecha_nacimiento'=>'1972-01-17'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>64,
			'curso_id'=>51,
			'profesor_id'=>64,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'40',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Diplomado"]',
			'mejor'=>'La forma en como se desarrollaron los contenidos',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>64
        ]);

        DB::table('profesors')->insert([
			'id'=>65,
			'nombres'=>'Miguel Angel',
			'apellido_paterno'=>'Hofmann',
			'apellido_materno'=>'Aguirre',
			'rfc'=>'HOAM720118HOAM',
			'numero_trabajador' => '121432465',
			'fecha_nacimiento'=>'1972-01-18'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>65,
			'curso_id'=>51,
			'profesor_id'=>65,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Aula invertida',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>65
        ]);

        DB::table('profesors')->insert([
			'id'=>66,
			'nombres'=>'Lucia Yazmin',
			'apellido_paterno'=>'Juarez',
			'apellido_materno'=>'De la Mora',
			'rfc'=>'JUDL720119JUDL',
			'numero_trabajador' => '121432466',
			'fecha_nacimiento'=>'1972-01-19'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>66,
			'curso_id'=>51,
			'profesor_id'=>66,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'5mentarios',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>66
        ]);

        DB::table('profesors')->insert([
			'id'=>67,
			'nombres'=>'José Miguel',
			'apellido_paterno'=>'Martinez',
			'apellido_materno'=>'Alcazar',
			'rfc'=>'MAAJ720120MAAJ',
			'numero_trabajador' => '121432467',
			'fecha_nacimiento'=>'1972-01-20'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>67,
			'curso_id'=>51,
			'profesor_id'=>67,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'60',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'La presentación de los temas',
            'sug'=>'Que se mejore la red de internet',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>67
        ]);

        DB::table('profesors')->insert([
			'id'=>68,
			'nombres'=>'Brenda Iveth',
			'apellido_paterno'=>'Moreno',
			'apellido_materno'=>'Hurtado',
			'rfc'=>'MOHB720121MOHB',
			'numero_trabajador' => '121432468',
			'fecha_nacimiento'=>'1972-01-21'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>68,
			'curso_id'=>51,
			'profesor_id'=>68,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["3","null"]',
			'mejor'=>'Habilidades para la vida y competencias personales y como aplicarlas',
            'sug'=>'Recalcal el tema del cuál se está hablando',
			'p4_1'=>'100',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["4"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>68
        ]);

        DB::table('profesors')->insert([
			'id'=>69,
			'nombres'=>'Georgina',
			'apellido_paterno'=>'Nieto',
			'apellido_materno'=>'Castañeda',
			'rfc'=>'NICG720122NICG',
			'numero_trabajador' => '121432469',
			'fecha_nacimiento'=>'1972-01-22'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>69,
			'curso_id'=>51,
			'profesor_id'=>69,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Las relfexiones grupales',
            'sug'=>'Incluir un ejemplo del formato de las tareas',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>69
        ]);

        DB::table('profesors')->insert([
			'id'=>70,
			'nombres'=>'Maria Teresa',
			'apellido_paterno'=>'Peñuñuri',
			'apellido_materno'=>'Santoyo',
			'rfc'=>'PESM720123PESM',
			'numero_trabajador' => '121432470',
			'fecha_nacimiento'=>'1972-01-23'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>70,
			'curso_id'=>51,
			'profesor_id'=>70,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Aula invertida y competencias',
            'sug'=>'Poner el Diplomado en el sitio de EDUCAFI para tener todos los módulos disponibles a lo larfo del diplomado',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'80',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'80',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>70
        ]);
        
        DB::table('profesors')->insert([
			'id'=>71,
			'nombres'=>'Soledad Alicia',
			'apellido_paterno'=>'Rivera',
			'apellido_materno'=>'Rosales',
			'rfc'=>'RIRS720124RIRS',
			'numero_trabajador' => '121432471',
			'fecha_nacimiento'=>'1972-01-24'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>71,
			'curso_id'=>51,
			'profesor_id'=>71,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'60',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Póster en FCA"]',
			'mejor'=>'El conocimiento de algunas hailidades que he desarrollado en la práctica docente',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>71
        ]);
        
        DB::table('profesors')->insert([
			'id'=>72,
			'nombres'=>'Mario Sinhue',
			'apellido_paterno'=>'Sanchez',
			'apellido_materno'=>'Dominguez',
			'rfc'=>'SADM720125SADM',
			'numero_trabajador' => '121432472',
			'fecha_nacimiento'=>'1972-01-25'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>72,
			'curso_id'=>51,
			'profesor_id'=>72,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'60',
			'p2_2'=>'60',
			'p2_3'=>'60',
			'p2_4'=>'60',
			'p3_1'=>'60',
			'p3_2'=>'60',
			'p3_3'=>'60',
			'p3_4'=>'60',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Trabajo y comunicación de trabajo en equipo',
            'sug'=>'Ninguna',
			'p4_1'=>'80',
			'p4_2'=>'80',
			'p4_3'=>'60',
			'p4_4'=>'80',
			'p4_5'=>'80',
			'p4_6'=>'80',
			'p4_7'=>'80',
			'p4_8'=>'80',
			'p4_9'=>'80',
			'p4_10'=>'80',
			'p4_11'=>'80',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>51,
			'participante_curso_id'=>72
        ]);

        DB::table('catalogo_cursos')->insert([
			'id'=> 52,
			'nombre_curso'=>'Módulo 5. Tendencias y estrategias de comunicación para la docencia',
			'duracion_curso' => '20',
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>1,
			'clave_curso'=>'TECDDGAPA5'
		]);
		
		DB::table('cursos')->insert([
			'id'=>52,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 52,
            'salon_id' => 2
			
        ]);

        DB::table('profesors')->insert([
            'id'=>96,
			'nombres'=>'Juan',
			'apellido_paterno'=>'Varela',
			'apellido_materno'=>'Juarez',
			'rfc'=>'VAJJ720205VAJJ',
			'numero_trabajador' => '121432496',
			'fecha_nacimiento'=>'1972-02-05'
        ]);

        DB::table('profesor_curso')->insert([
			'id'=>62,
			'curso_id'=>52,
			'profesor_id'=>96,
        ]);

        DB::table('participante_curso')->insert([
			'id'=>73,
			'curso_id'=>52,
			'profesor_id'=>60,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Profesor"]',
			'mejor'=>'Respuesta en Blanco',
            'sug'=>'Respuesta en Blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'Cualquiera',
			'horarioi'=>'Cualquiera',
			'curso_id'=>52,
			'participante_curso_id'=>73
        ]);

        DB::table('participante_curso')->insert([
			'id'=>74,
			'curso_id'=>52,
			'profesor_id'=>61,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'La relfexion sobre la inteligencia emocional en nuestros alumnos y en forma personal',
            'sug'=>'Ninguna, gracias',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'Cualquiera',
			'horarioi'=>'Cualquiera',
			'curso_id'=>52,
			'participante_curso_id'=>74
        ]);

        DB::table('participante_curso')->insert([
			'id'=>75,
			'curso_id'=>52,
			'profesor_id'=>62,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'La relfexion sobre la inteligencia emocional en nuestros alumnos y en forma personal',
            'sug'=>'Ninguna, gracias',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'Cualquiera',
			'horarioi'=>'Cualquiera',
			'curso_id'=>52,
            'participante_curso_id'=>75
        ]);

        DB::table('participante_curso')->insert([
			'id'=>76,
			'curso_id'=>52,
			'profesor_id'=>63,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El conocer como se maneja la inteligencia emocional y que puede ser aplicada en el aula. Identificar cada una de las emociones que rige el docente en el aula',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'Cualquiera',
			'horarioi'=>'Cualquiera',
			'curso_id'=>52,
            'participante_curso_id'=>76
        ]);

        DB::table('participante_curso')->insert([
			'id'=>77,
			'curso_id'=>52,
			'profesor_id'=>64,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'40',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'La temática de la inteligencia emocional',
            'sug'=>'Este módulo podría ser útil como un cuirso en intersemestral o semestral',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'80',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>77
        ]);

        DB::table('participante_curso')->insert([
			'id'=>78,
			'curso_id'=>52,
			'profesor_id'=>65,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El conocer la utilidad de la inteligencia emocional dentro y fuera del aula',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>78
        ]);

        DB::table('participante_curso')->insert([
			'id'=>79,
			'curso_id'=>52,
			'profesor_id'=>66,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["null","null"]',
			'mejor'=>'Todo lo que aportó el instructor y mis compañeros en el tema de Inteligencia emocional',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>79
        ]);

        DB::table('participante_curso')->insert([
			'id'=>80,
			'curso_id'=>52,
			'profesor_id'=>67,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Coordinacion del Centro"]',
			'mejor'=>'La presentación y profundidad de los temas por el instructor',
            'sug'=>'Ninguna, todo excelente.Desde los detalles, la recomendación de los libros y lecturas',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>80
        ]);

        DB::table('participante_curso')->insert([
			'id'=>81,
			'curso_id'=>52,
			'profesor_id'=>68,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El conocer la utilidad de la inteligencia emocional dentro y fuera del aula',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>81
        ]);

        DB::table('participante_curso')->insert([
			'id'=>82,
			'curso_id'=>52,
			'profesor_id'=>69,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Las reflexiones, los ejercicios de integración y las pruebas',
            'sug'=>'Es el módulo que más me ha gustaro del Diplomado',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>82
        ]);

        DB::table('participante_curso')->insert([
			'id'=>83,
			'curso_id'=>52,
			'profesor_id'=>70,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El conocer la utilidad de la inteligencia emocional dentro y fuera del aula',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>83
        ]);

        DB::table('participante_curso')->insert([
			'id'=>84,
			'curso_id'=>52,
			'profesor_id'=>71,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'80',
			'p2_2'=>'60',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Póster en FCA"]',
			'mejor'=>'Conocer mi estilo de pensamiento y las evaluaciones del tipo de pensamiento',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'80',
			'p4_6'=>'100',
			'p4_7'=>'80',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>84
        ]);

        DB::table('participante_curso')->insert([
			'id'=>85,
			'curso_id'=>52,
			'profesor_id'=>72,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'60',
			'p1_3'=>'60',
			'p1_4'=>'80',
			'p1_5'=>'80',
			'p2_1'=>'60',
			'p2_2'=>'60',
			'p2_3'=>'60',
			'p2_4'=>'60',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'En blanco',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'80',
			'p4_3'=>'80',
			'p4_4'=>'80',
			'p4_5'=>'80',
			'p4_6'=>'80',
			'p4_7'=>'80',
			'p4_8'=>'100',
			'p4_9'=>'80',
			'p4_10'=>'80',
			'p4_11'=>'80',
            'otros'=>'Otros',
			'conocimiento'=>'["4"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>52,
            'participante_curso_id'=>85
        ]);

        DB::table('catalogo_cursos')->insert([
			'id'=> 53,
			'nombre_curso'=>'Módulo 6. Tendencias y estrategias de comunicación para la docencia',
			'duracion_curso' => '20',
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>1,
			'clave_curso'=>'TECDDGAPA6'
		]);
		
		DB::table('cursos')->insert([
			'id'=>53,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 53,
            'salon_id' => 2
			
        ]);

        DB::table('profesors')->insert([
            'id'=>97,
			'nombres'=>'Juan',
			'apellido_paterno'=>'Tapia',
			'apellido_materno'=>'Gonzalez',
			'rfc'=>'TAGJ720206TAGL',
			'numero_trabajador' => '121432497',
			'fecha_nacimiento'=>'1972-02-06'
        ]);

        DB::table('profesor_curso')->insert([
			'id'=>63,
			'curso_id'=>53,
			'profesor_id'=>97,
        ]);

        DB::table('participante_curso')->insert([
			'id'=>86,
			'curso_id'=>53,
			'profesor_id'=>60,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'60',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Profesor"]',
			'mejor'=>'Cada clase del método fue única',
            'sug'=>'Qué continúe el instructor motivando a más profesores a desarrollar su liderazgp para que estos impacten de manera positiva en los futuros',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>86
        ]);

        DB::table('participante_curso')->insert([
			'id'=>87,
			'curso_id'=>53,
			'profesor_id'=>61,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Aprender nuevas estrategias, nuevas metodologías para aplicar en el aula, sin olvidar mi función como líder de mis alumnos',
            'sug'=>'Más tiempo para los ejercicios',
			'p4_1'=>'100',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>87
        ]);

        DB::table('participante_curso')->insert([
			'id'=>88,
			'curso_id'=>53,
			'profesor_id'=>62,
			'asistencia'=>true,
			'acreditacion'=>true
		]);

        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Todos los temas de los módulos, y las herramientas de aplicación inmediata',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>88
        ]);

        DB::table('participante_curso')->insert([
			'id'=>89,
			'curso_id'=>53,
			'profesor_id'=>63,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Las diferentes estrategias didácticas implementadas',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["4"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>89
        ]);

        DB::table('participante_curso')->insert([
			'id'=>90,
			'curso_id'=>53,
			'profesor_id'=>64,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'80',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'80',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Las estrategias didácticas novedosas para aplicar en el aula',
            'sug'=>'Que exista un curso de mayor número de horas de esta temática (liderazgo) con este instructor',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>90
        ]);

        DB::table('participante_curso')->insert([
			'id'=>91,
			'curso_id'=>53,
			'profesor_id'=>65,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Todo, cada sesión fue interesante y productiva',
            'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>91
        ]);

        DB::table('participante_curso')->insert([
			'id'=>92,
			'curso_id'=>53,
			'profesor_id'=>66,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Otros"]',
			'mejor'=>'Las clases muy dinámicas',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>92
        ]);

        DB::table('participante_curso')->insert([
			'id'=>93,
			'curso_id'=>53,
			'profesor_id'=>67,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Por la Coordinación"]',
			'mejor'=>'Las exposiciones y los trabajos aplicativos durante la clase que permitieron la aplicación de la teoría',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>93
        ]);

        DB::table('participante_curso')->insert([
			'id'=>94,
			'curso_id'=>53,
			'profesor_id'=>68,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'80',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["3","null"]',
			'mejor'=>'Aprender estrategias',
            'sug'=>'Aterrizar y resaltar el tema del que se habla',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'80',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>94
        ]);

        DB::table('participante_curso')->insert([
			'id'=>95,
			'curso_id'=>53,
			'profesor_id'=>69,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'60',
			'p1_2'=>'60',
			'p1_3'=>'60',
			'p1_4'=>'40',
			'p1_5'=>'60',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'80',
			'p2_4'=>'60',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Las dinámicas eran muy buenas, pero en mi opinión, no acordes al módulo',
            'sug'=>'Este módulo me pareció muy improvisado, el material que nos dejaron leer nunca se discutió en clase y me pareció algo obsoleto',
			'p4_1'=>'60',
			'p4_2'=>'40',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'80',
			'p4_6'=>'80',
			'p4_7'=>'80',
			'p4_8'=>'80',
			'p4_9'=>'80',
			'p4_10'=>'80',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["2"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>95
        ]);

        DB::table('participante_curso')->insert([
			'id'=>96,
			'curso_id'=>53,
			'profesor_id'=>70,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);

        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'80',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'80',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Las actividades en equipo',
            'sug'=>'Revisar el formato de entrega de tareas, ya que por erro no se plantearon las estrategias de las tareas y el trabajo final.',
			'p4_1'=>'100',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'80',
			'p4_6'=>'100',
			'p4_7'=>'80',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>96
        ]);

        DB::table('participante_curso')->insert([
			'id'=>97,
			'curso_id'=>53,
			'profesor_id'=>71,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","Póster en FCA"]',
			'mejor'=>'El modo de poder, querer y romper cambiar paradigmas',
            'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>97
        ]);

        DB::table('participante_curso')->insert([
			'id'=>98,
			'curso_id'=>53,
			'profesor_id'=>72,
			'asistencia'=>true,
			'acreditacion'=>true
        ]);
        
        DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'60',
			'p1_2'=>'60',
			'p1_3'=>'80',
			'p1_4'=>'60',
			'p1_5'=>'80',
			'p2_1'=>'80',
			'p2_2'=>'60',
			'p2_3'=>'60',
			'p2_4'=>'60',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'60',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Experiencias profesionales del instructor',
            'sug'=>'En blanco',
			'p4_1'=>'80',
			'p4_2'=>'60',
			'p4_3'=>'80',
			'p4_4'=>'60',
			'p4_5'=>'80',
			'p4_6'=>'60',
			'p4_7'=>'80',
			'p4_8'=>'60',
			'p4_9'=>'60',
			'p4_10'=>'80',
			'p4_11'=>'60',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-11:00',
			'horarioi'=>'9:00-13:00',
			'curso_id'=>53,
            'participante_curso_id'=>98
        ]);

		DB::table('coordinacions')->insert([
			'id'=>51,
			'abreviatura'=>'ADIE',
			'nombre_coordinacion'=>'Área Disciplinar e Investigación educativa',
			'coordinador'=>'Gonzalo Lopez Juarez',
			'grado'=>'M.E.M.',
			'usuario'=>'G0nz4l0o1nEZ',
			'password'=>'$10$Sli0p2.SdjP7JTbyze.RIucCUJA5MOG6AEB40sJG3Ok3Kb33ltibm'
		]);

        DB::table('catalogo_cursos')->insert([
			'id'=> 54,
			'nombre_curso'=>'Programación de máquinas de control numérico (CNC)',
			'duracion_curso' => '20',
            'coordinacion_id' => 51,
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>51,
			'clave_curso'=>'PMCCNC'
		]);
		
		DB::table('cursos')->insert([
			'id'=>54,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 54,
            'salon_id' => 2
			
        ]);
        
        DB::table('profesors')->insert([
            'id'=>98,
			'nombres'=>'Jose Javier',
			'apellido_paterno'=>'Cervantes',
			'apellido_materno'=>'Cabello',
			'rfc'=>'CECJ720207CECJ',
			'numero_trabajador' => '121432498',
			'fecha_nacimiento'=>'1972-02-07'
        ]);
		
		DB::table('profesor_curso')->insert([
			'id'=>58,
			'curso_id'=>54,
			'profesor_id'=>98,
		]);
		
		DB::table('profesors')->insert([
			'id'=>73,
			'nombres'=>'Estefania',
			'apellido_paterno'=>'Abarca',
			'apellido_materno'=>'Rodriguez',
			'rfc'=>'ABRE73102ABRE',
			'numero_trabajador' => '121432473',
			'fecha_nacimiento'=>'1973-01-02'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>99,
			'curso_id'=>54,
			'profesor_id'=>73,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Ver el maquineo físicamente',
			'sug'=>'Abrir más cursos de como CAD o CAM',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>99
        ]);
        
        
		DB::table('profesors')->insert([
			'id'=>74,
			'nombres'=>'Salvador',
			'apellido_paterno'=>'Centeno',
			'apellido_materno'=>'Estrada',
			'rfc'=>'CEES73103CEES',
			'numero_trabajador' => '121432474',
			'fecha_nacimiento'=>'1973-01-03'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>100,
			'curso_id'=>54,
			'profesor_id'=>74,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","2","null"]',
			'mejor'=>'El contenido en sí y la simulación',
			'sug'=>'Todo excelente',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>100
        ]);
        
        
		DB::table('profesors')->insert([
			'id'=>75,
			'nombres'=>'Jesus Javier',
			'apellido_paterno'=>'Cortes',
			'apellido_materno'=>'Rosas',
			'rfc'=>'CORJ73104CORJ',
			'numero_trabajador' => '121432475',
			'fecha_nacimiento'=>'1973-01-04'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>101,
			'curso_id'=>54,
			'profesor_id'=>75,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'80',
			'p1_4'=>'100',
			'p1_5'=>'80',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'El compañerismo',
			'sug'=>'Todo bien',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'80',
			'p4_4'=>'80',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>101
        ]);
        
		DB::table('profesors')->insert([
			'id'=>76,
			'nombres'=>'Miguel Eduardo',
			'apellido_paterno'=>'Gonzalez',
			'apellido_materno'=>'Cardenas',
			'rfc'=>'GOCM73105GOCM',
			'numero_trabajador' => '121432476',
			'fecha_nacimiento'=>'1973-01-05'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>102,
			'curso_id'=>54,
			'profesor_id'=>76,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'60',
			'p2_3'=>'80',
			'p2_4'=>'20',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","2","null"]',
			'mejor'=>'Programación',
			'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["3"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>102
        ]);
        
        DB::table('profesors')->insert([
			'id'=>77,
			'nombres'=>'Jose Luis',
			'apellido_paterno'=>'Ramirez',
			'apellido_materno'=>'Cruz',
			'rfc'=>'RACJ73106RACJ',
			'numero_trabajador' => '121432477',
			'fecha_nacimiento'=>'1973-01-06'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>103,
			'curso_id'=>54,
			'profesor_id'=>77,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'20',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'La capacidad del instructor',
			'sug'=>'Ninguna',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>103
        ]);
        
        DB::table('profesors')->insert([
			'id'=>78,
			'nombres'=>'Rodrigo Alberto',
			'apellido_paterno'=>'Rincon',
			'apellido_materno'=>'Gomez',
			'rfc'=>'RIGR73107RIGR',
			'numero_trabajador' => '121432478',
			'fecha_nacimiento'=>'1973-01-07'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>104,
			'curso_id'=>54,
			'profesor_id'=>78,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'60',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'60',
			'p3_1'=>'80',
			'p3_2'=>'80',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["4","aquí mismo"]',
			'mejor'=>'La interacción',
			'sug'=>'Poner más en alto los pizarrones',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>104
		]);

        DB::table('profesors')->insert([
			'id'=>79,
			'nombres'=>'Jesus',
			'apellido_paterno'=>'Castro',
			'apellido_materno'=>'Rodriguez',
			'rfc'=>'CARJ73108CARJ',
			'numero_trabajador' => '121432479',
			'fecha_nacimiento'=>'1973-01-08'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>105,
			'curso_id'=>54,
			'profesor_id'=>79,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["1","null"]',
			'mejor'=>'Todo',
			'sug'=>'Sin',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
			'p4_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["4"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>54,
			'participante_curso_id'=>105
        ]);
		
		DB::table('coordinacions')->insert([
			'id'=>52,
			'abreviatura'=>'ADEE',
			'nombre_coordinacion'=>'Área Disciplinar y evaluación educativa',
			'coordinador'=>'Roman Dominguez Perez',
			'grado'=>'M.E.M.',
			'usuario'=>'R0m4n1nEZ',
			'password'=>'$10$Sli0p2.SdjP7JTbyze.RIucCUJA5MOG6AEB40sJG3Ok3Kb33ltibn'
		]);

        DB::table('catalogo_cursos')->insert([
			'id'=> 55,
			'nombre_curso'=>'Redescubriendo a la vida de Michael Faraday',
			'duracion_curso' => '20',
            'coordinacion_id' => 52,
            'tipo' => 'C',
            'institucion' => 'DGAPA',
			'fecha_disenio'=>'2012-12-12',
			'coordinacion_id'=>52,
			'clave_curso'=>'RVMFEYMEE'
		]);
		
		DB::table('cursos')->insert([
			'id'=>55,
			'semestre_anio'=>2020,
			'semestre_pi'=>'1',
			'semestre_si'=>'s',
			'fecha_inicio' => '2018-05-20',
            'fecha_fin' => '2018-05-30',
            'hora_inicio' => '14:00',
            'hora_fin' => '16:00',
            'dias_semana' => 'Lunes,Miércoles',
            'numero_sesiones' => 10,
            'texto_diploma' => 'Texto diploma',
            'costo' => 2000,
            'cupo_maximo' => 20,
            'cupo_minimo' => 5,
            'catalogo_id' => 55,
            'salon_id' => 1
			
        ]);
        
        DB::table('profesors')->insert([
            'id'=>99,
			'nombres'=>'Martin',
			'apellido_paterno'=>'Barcenas',
			'apellido_materno'=>'Escobar',
			'rfc'=>'BAEM720208BAEM',
			'numero_trabajador' => '121432499',
			'fecha_nacimiento'=>'1972-02-08'
        ]);
		
		DB::table('profesor_curso')->insert([
			'id'=>59,
			'curso_id'=>55,
			'profesor_id'=>99,
        ]);

        DB::table('profesors')->insert([
            'id'=>100,
			'nombres'=>'Rigel',
			'apellido_paterno'=>'Gamez',
			'apellido_materno'=>'Lael',
			'rfc'=>'GALR720209GALR',
			'numero_trabajador' => '1214324100',
			'fecha_nacimiento'=>'1972-02-09'
        ]);

        DB::table('profesor_curso')->insert([
			'id'=>60,
			'curso_id'=>55,
			'profesor_id'=>100,
        ]);

        DB::table('profesors')->insert([
            'id'=>101,
			'nombres'=>'Juan Manuel',
			'apellido_paterno'=>'Gil',
			'apellido_materno'=>'Perez',
			'rfc'=>'GIPJ720210GIPJ',
			'numero_trabajador' => '1214324101',
			'fecha_nacimiento'=>'1972-02-10'
        ]);

        DB::table('profesor_curso')->insert([
			'id'=>61,
			'curso_id'=>55,
			'profesor_id'=>101,
		]);
		
		DB::table('profesors')->insert([
			'id'=>80,
			'nombres'=>'Eduardo',
			'apellido_paterno'=>'Bernal',
			'apellido_materno'=>'Vargas',
			'rfc'=>'BEVE74102BEVE',
			'numero_trabajador' => '121432480',
			'fecha_nacimiento'=>'1973-01-04'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>106,
			'curso_id'=>55,
			'profesor_id'=>80,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'INTERES SOBRE LA VIDA DE ESTE CIENTIFICO',
			'sug'=>'NINGUNA',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>106
        ]);

        DB::table('profesors')->insert([
			'id'=>81,
			'nombres'=>'Juan Carlos',
			'apellido_paterno'=>'Cedeño',
			'apellido_materno'=>'Vazquez',
			'rfc'=>'CEVJ740403CEVJ',
			'numero_trabajador' => '121432481',
			'fecha_nacimiento'=>'1973-04-03'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>107,
			'curso_id'=>55,
			'profesor_id'=>81,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocer más de la vida de Michael Faraday y tratar de leer sobre la vida de otros personajes reconocidos',
			'sug'=>'Bien este tipo de seminarios de más, impartirse en más tiempo',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>107
        ]);
        
        DB::table('profesors')->insert([
			'id'=>82,
			'nombres'=>'Martha Rosa',
			'apellido_paterno'=>'Del Moral',
			'apellido_materno'=>'Nieto',
			'rfc'=>'DENM740404DENM',
			'numero_trabajador' => '121432482',
			'fecha_nacimiento'=>'1973-04-04'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>108,
			'curso_id'=>55,
			'profesor_id'=>82,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocimiento de un cientifico tan impoertante como lo fue Michael Faraday las aportaciones que dejo a la fisica y el magnetismo',
			'sug'=>'Muchas gracias por compartir sus conocimientos a los tres instructores',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>108
        ]);

        DB::table('profesors')->insert([
			'id'=>83,
			'nombres'=>'Vianey',
			'apellido_paterno'=>'Franco',
			'apellido_materno'=>'Garcia',
			'rfc'=>'FAGV740405FAGV',
			'numero_trabajador' => '121432483',
			'fecha_nacimiento'=>'1973-04-05'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>109,
			'curso_id'=>55,
			'profesor_id'=>83,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'60',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocimiento histórico de la época de los descubrimientos con los experimentos de Faraday. Aportación a la ciencia y aplicación para los experimentos',
			'sug'=>'Muchas gracias por compartir sus conocimientos a los tres instructores',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>109
        ]);

        DB::table('profesors')->insert([
			'id'=>84,
			'nombres'=>'Raymundo',
			'apellido_paterno'=>'Gaytan',
			'apellido_materno'=>'Perez',
			'rfc'=>'GAPR740406GAPR',
			'numero_trabajador' => '121432484',
			'fecha_nacimiento'=>'1973-04-06'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>110,
			'curso_id'=>55,
			'profesor_id'=>84,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'80',
			'p2_1'=>'60',
			'p2_2'=>'60',
			'p2_3'=>'80',
			'p2_4'=>'80',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocer la vida y obre de Michael Faraday y sus aportaciones científicas',
			'sug'=>'Conocer la vida y obra de otros científicos importantes que cambiaron a la humanidad',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>110
        ]);

        DB::table('profesors')->insert([
			'id'=>85,
			'nombres'=>'Arnulfo',
			'apellido_paterno'=>'Ortiz',
			'apellido_materno'=>'Gomez',
			'rfc'=>'ORGA740407ORGA',
			'numero_trabajador' => '121432485',
			'fecha_nacimiento'=>'1973-04-07'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>111,
			'curso_id'=>55,
			'profesor_id'=>85,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'100',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'La gran capacidad de observación de Faraday',
			'sug'=>'El tiempo para el curso es el adecuado no lo modifiquen; adecuar el horario para salir a las 18',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>111
        ]);

        DB::table('profesors')->insert([
			'id'=>86,
			'nombres'=>'Antonia del Carmen',
			'apellido_paterno'=>'Perez',
			'apellido_materno'=>'Leon',
			'rfc'=>'PELA740408PELA',
			'numero_trabajador' => '121432486',
			'fecha_nacimiento'=>'1973-04-08'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>112,
			'curso_id'=>55,
			'profesor_id'=>86,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'80',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Aprendizaje y curiosidad por seguir preparandome, en temas actuales',
			'sug'=>'En blanco',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>112
        ]);
        
        DB::table('profesors')->insert([
			'id'=>87,
			'nombres'=>'Jose Luis',
			'apellido_paterno'=>'Salas',
			'apellido_materno'=>'Corrales',
			'rfc'=>'SACOJ740410SACOJ',
			'numero_trabajador' => '121432487',
			'fecha_nacimiento'=>'1973-04-10'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>113,
			'curso_id'=>55,
			'profesor_id'=>87,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'80',
			'p2_1'=>'60',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocimiento sobre Faraday y varias ideas para aplicar en mi labor docente',
			'sug'=>'Realizar un siguiente taller de elaboración de experimentos',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>113
        ]);

        DB::table('profesors')->insert([
			'id'=>88,
			'nombres'=>'Victor Manuel',
			'apellido_paterno'=>'Sanchez',
			'apellido_materno'=>'Ezquivel',
			'rfc'=>'SAEV740411SAEV',
			'numero_trabajador' => '121432488',
			'fecha_nacimiento'=>'1973-04-11'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>114,
			'curso_id'=>55,
			'profesor_id'=>88,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'80',
			'p1_2'=>'80',
			'p1_3'=>'80',
			'p1_4'=>'80',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'60',
			'p2_3'=>'60',
			'p2_4'=>'60',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'80',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocimiento de la vida de M. Faraday las características que que tenía',
			'sug'=>'Realizar al menos un experimento con su teoría de tal manera que ser entendido por todos os asistentes al seminario',
			'p4_1'=>'80',
			'p4_2'=>'80',
			'p4_3'=>'100',
			'p4_4'=>'80',
			'p4_5'=>'80',
			'p4_6'=>'80',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'80',
            'p5_1'=>'80',
			'p5_2'=>'80',
			'p5_3'=>'80',
			'p5_4'=>'80',
			'p5_5'=>'80',
			'p5_6'=>'80',
			'p5_7'=>'80',
			'p5_8'=>'80',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'80',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'80',
			'p6_6'=>'80',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'80',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>114
        ]);

        DB::table('profesors')->insert([
			'id'=>89,
			'nombres'=>'Jose Alejandor',
			'apellido_paterno'=>'Sanchez',
			'apellido_materno'=>'Perez',
			'rfc'=>'SAPJ40412SAPJ',
			'numero_trabajador' => '121432489',
			'fecha_nacimiento'=>'1973-04-12'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>115,
			'curso_id'=>55,
			'profesor_id'=>89,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'80',
			'p3_2'=>'100',
			'p3_3'=>'80',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'experiencia historica, claridad en conceptos, experiencias experimental',
			'sug'=>'Hacer uso del clima de forma intermitente para que la temperatura del aula sea más agradable',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'80',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>115
        ]);
        
        DB::table('profesors')->insert([
			'id'=>90,
			'nombres'=>'Enrique',
			'apellido_paterno'=>'Villalobos',
			'apellido_materno'=>'Perez',
			'rfc'=>'VIPE40413VIPE',
			'numero_trabajador' => '121432490',
			'fecha_nacimiento'=>'1973-04-13'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>116,
			'curso_id'=>55,
			'profesor_id'=>90,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'80',
			'p2_2'=>'80',
			'p2_3'=>'80',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["2","null"]',
			'mejor'=>'Conocimiento, experiencia didáctica y trabajo colaborativo',
			'sug'=>'Felicat a los participantes',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>116
        ]);

        
        DB::table('profesors')->insert([
			'id'=>91,
			'nombres'=>'Ricardo',
			'apellido_paterno'=>'Yañez',
			'apellido_materno'=>'Valdez',
			'rfc'=>'YAVR40414YAVR',
			'numero_trabajador' => '121432491',
			'fecha_nacimiento'=>'1973-04-14'
		]);
		
		DB::table('participante_curso')->insert([
			'id'=>117,
			'curso_id'=>55,
			'profesor_id'=>91,
			'asistencia'=>true,
			'acreditacion'=>true
		]);
		
		DB::table('_evaluacion_final_curso')->insert([
			'p1_1'=>'100',
			'p1_2'=>'100',
			'p1_3'=>'100',
			'p1_4'=>'100',
			'p1_5'=>'100',
			'p2_1'=>'100',
			'p2_2'=>'80',
			'p2_3'=>'100',
			'p2_4'=>'100',
			'p3_1'=>'100',
			'p3_2'=>'100',
			'p3_3'=>'100',
			'p3_4'=>'100',
			'p7'=>true,
			'p8'=>'["4","correo"]',
			'mejor'=>'Conocer la vida de M. Faraday y que continuaré conociendo más sobre él',
			'sug'=>'todo me gustó',
			'p4_1'=>'100',
			'p4_2'=>'100',
			'p4_3'=>'100',
			'p4_4'=>'100',
			'p4_5'=>'100',
			'p4_6'=>'100',
			'p4_7'=>'100',
			'p4_8'=>'100',
			'p4_9'=>'100',
			'p4_10'=>'100',
            'p4_11'=>'100',
            'p5_1'=>'100',
			'p5_2'=>'100',
			'p5_3'=>'100',
			'p5_4'=>'100',
			'p5_5'=>'100',
			'p5_6'=>'100',
			'p5_7'=>'100',
			'p5_8'=>'100',
			'p5_9'=>'100',
			'p5_10'=>'100',
            'p5_11'=>'100',
            'p6_1'=>'100',
			'p6_2'=>'100',
			'p6_3'=>'100',
			'p6_4'=>'100',
			'p6_5'=>'100',
			'p6_6'=>'100',
			'p6_7'=>'100',
			'p6_8'=>'100',
			'p6_9'=>'100',
			'p6_10'=>'100',
			'p6_11'=>'100',
            'otros'=>'Otros',
			'conocimiento'=>'["1"]',
			'tematica'=>'tematica',
			'horarios'=>'9:00-13:00',
			'horarioi'=>'13:00-15:00',
			'curso_id'=>55,
			'participante_curso_id'=>117
        ]);

    }
}
