@extends('layouts.principal')

@section('contenido')

<script>

	var f = new Date();
	//Pasamos el objeto Query a objeto tipo json
	var date = <?php echo json_encode($curso); ?>;
	//Extraemos la fecha del objeto json
	var curso_date = date.fecha_fin;
	//Separamos la fecha por '-' (dato tipo string)
	var dates =curso_date.split('-');
	
	var encuestas = <?php echo json_encode($evaluaciones); ?>;
	var encuesta_final = <?php echo json_encode($final); ?>
	
	console.log(encuestas.length);
	console.log(encuestas);
	console.log(encuesta_final.length);
	console.log(dates[0]);
	console.log(dates[1]);
	console.log(dates[2]);
	console.log(f.getFullYear());
	console.log(f.getMonth()+1);
	console.log(f.getDate());
  
	if(encuestas.length >= 1){
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("dia").disabled = true; // habilitar
		});
	}else{
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("dia").disabled = false; // habilitar
		});
	}
  
	//f.getFullYear() retorna año actual, f.getMoth() retorna mes actual, f.getDate() retorna día actual
	if(parseInt(dates[0])<f.getFullYear() && encuesta_final.length <= 0){
		//Si está cargada la página actúa
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("final").disabled = false; // habilitar
		});
	}else if (parseInt(dates[0]) == f.getFullYear() && parseInt(dates[1]) < f.getMonth()+1  && encuesta_final.length <= 0) {
		//Si está cargada la página actúa
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("final").disabled = false; // habilitar
		});
	}else if (parseInt(dates[0]) == f.getFullYear() && parseInt(dates[1]) == f.getMonth()+1  && parseInt(dates[2]) <= f.getDate() && encuesta_final.length <= 0) {
		//Si está cargada la página actúa
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("final").disabled = false; // habilitar
		});
	} else {
		//Si está cargada la página actúa
		document.addEventListener("DOMContentLoaded", function(event) {
			document.getElementById("final").disabled = true; // habilitar
		});
	}
		
</script>
  @if (session()->has('msj'))
	<p align="center" style="color:green;">{{ session('msj') }}<strong></strong></p>
  @endif

  <div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>
    <section class="content-inner">
    <br>
      <div class="panel panel-default">
                <div class="panel-heading">
                    <h3> Curso:  {{ $catalogoCurso->nombre_curso }}</h3>
					<h4> Instructor: {{ $curso->getProfesores() }}</h4>
                   
                    <h4> Tipo:  {{ $catalogoCurso->tipo }}</h4>
                    <h5> Fecha de Inicio:  {{ $curso->fecha_inicio }}</h5>
                    <h5> Fecha de Fin:  {{ $curso->fecha_fin }}</h5>
                    <h4> Fecha:  {{ $curso->getToday() }}</h4>
                </div>
                <div class="panel-body">
					<button id="dia"  type="button" class="btn btn-primary active"> <a href="{{ route('evaluacion.porSesion',[ $profesor->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación por sesión </a> </button>
					<button id="final" type="button" class="btn btn-primary active"> <a href="{{ route('evaluacion.porCurso',[ $profesor->id,$curso->id,$catalogoCurso->id,$count] ) }}" style="color:white">Evaluación final</a></button> 		
                </div>

     </section>
	
    <br><br>
	
@endsection