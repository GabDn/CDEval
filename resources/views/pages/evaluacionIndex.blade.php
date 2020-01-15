@extends('layouts.principal')

@section('contenido')
<script>
  var f = new Date();
  //console.log(document.write(f))
  if ($curso->fecha_fin < f.getDate()){
    document.getElementById("dia").disabled = false; // deshabilitar
    document.getElementById("final").disabled = true; // habilitar
  } elseif($curso->fecha_fin = f.getDate()){
    document.getElementById("dia").disabled = false; // habilitar
    document.getElementById("final").disabled = false; // habilitar
  } 
  else {
    document.getElementById("dia").disabled = true; // deshabilitar
    document.getElementById("final").disabled = true; // habilitar
  }
</script>

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
                    <h4> Instructor:  {{ $profesor->nombres }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</h4>
                    <h4> Tipo:  {{ $catalogoCurso->tipo }}</h4>
                    <h5> Fecha de Inicio:  {{ $curso->fecha_inicio }}</h5>
                    <h5> Fecha de Fin:  {{ $curso->fecha_fin }}</h5>
                    <h4> Fecha:  {{ $curso->getToday() }}</h4>
                </div>
                <div class="panel-body">
                  <button><a id="dia" href="{{ route('evaluacion.porSesion',[ $profesor->id,$curso->id,$catalogoCurso->id,$count] ) }}" type="button" class="btn btn-primary active"> Evaluación por día</a></button>
                  <button><a id="final" href="{{ route('evaluacion.porCurso',[ $profesor->id,$curso->id,$catalogoCurso->id,$count] ) }}" type="button" class="btn btn-primary active">Evaluación por curso</a></button> 
                </div>

     </section>
     
    <br><br>
     @endsection