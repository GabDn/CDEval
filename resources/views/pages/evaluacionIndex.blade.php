@extends('layouts.principal')

@section('contenido')


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


                    <h4> Fecha:  {{ getdate()['year'] }}</h4>


                </div>
                <button><a href="{{ route('evaluacion.porSesion',[ $profesor->id,$curso->id,$catalogoCurso->id] ) }}" type="button" class="btn btn-primary active"> Evaluación por día</a></button>
                <button><a href="{{ route('evaluacion.porCurso',[ $profesor->id,$curso->id,$catalogoCurso->id] ) }}" type="button" class="btn btn-primary active">Evaluación por curso</a></button>

                <div class="panel-body">

                
                
                </div>

     </section>
     

     @endsection