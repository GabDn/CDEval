<!-- Guardado en resources/views/pages/admin.blade.php -->

@extends('layouts.coordinadores')

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
                    <h3>Bienvenid@<!--   {{ $encargado->coordinador }} --></h3>
                    <!-- <h3>Coordinación de {{ $encargado->nombre_coordinacion }}</h3> -->
                </div>
                <div class="panel-body">

                  <div class="logos col-md-12 col-center">
                      <img class="img-escudo" src="{{ asset('img/cdd.png') }}">
                      Centro de Docencia. Evaluaciones 
                  </div>
                  <br>
                  <hr>
                  <button id="final" type="button" class="btn btn-primary active"> <a href="{{ route('coordinacion.pdf',['coordinacion_id'=>$encargado->id,'message'=>'0']) }}" style="color:white">Evaluación de área</a></button> 

                
                </div>

     </section>
     
@endsection