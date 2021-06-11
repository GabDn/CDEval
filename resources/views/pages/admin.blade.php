<!-- Guardado en resources/views/pages/admin.blade.php -->

@extends('layouts.principal')

@section('contenido')
  <!--Body content-->

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
		@include ('partials.messages')
      <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Bienvenido Prof(a). {{ $profesor->nombres }} {{ $profesor->apellido_paterno }}</h3>
                </div>
                <div class="panel-body">

                  <div class="logos col-md-12 col-center">
                      <img class="img-escudo" src="{{ asset('img/cdd.png') }}">
                      Centro de Docencia. Evaluaciones
                      </h3>
                  
                  </div>
				<br>
				<br>
					<button id="dia"  type="button" class="btn btn-primary active"><a href="{{ route('evaluacion.enviarClaveCursoHistorico',[ $profesor->id] ) }}" style="color:white">Enviar historial cursos</a></button>
					<button id="dia"  type="button" class="btn btn-primary active"><a href="{{ route('evaluacion.enviarClaveFecha',[ $profesor->id] ) }}" style="color:white">Enviar cursos por fecha</a></button>
                </div>

     </section>
     <br>
@endsection