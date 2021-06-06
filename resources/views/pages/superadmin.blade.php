<!-- Guardado en resources/views/pages/admin.blade.php -->

@extends('layouts.app')

@section('contenido')
  <!--Body content-->

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
                    <h3>Bienvenid@</h3>
                </div>
                <div class="panel-body">

                  <div class="logos col-md-12 col-center">
                      <img class="img-escudo" src="{{ asset('img/cdd.png') }}">
                      Centro de Docencia. Evaluaciones
                      </h3>
                  
                  </div>

                  <a href="{{ route('elegir.fecha',['message'=>0]) }}" class="btn btn-primary">Enviar historial cursos</a>
                  <a href="{{ route('elegir.coordinacion',['message'=>0]) }}" class="btn btn-primary">Enviar historial cursos Coordinacion</a>
                
                </div>

     </section>
     
@endsection