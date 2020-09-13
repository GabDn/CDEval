@extends('layouts.coordinadores')

@section('contenido')
  <!--Body content-->

@if($message != '0')
    <div class="alert alert-success" style = "text-align:center;"> {{ $message }}</div>
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
        <h3> Área:  Seleccione semestre</h3>
      </div>
      <div class="panel-body">
      <form method="POST" action="{{ route('enviar.area.pdf')}}">
				<select name='semestre' width="25%">
          <?php 
            foreach($fechas as $fecha){
              echo "<option value=$fecha>$fecha</option>";
            }
          ?>
				</select>
        <select name='periodo' with = '25%'>
            <option value='s'>s</option>
            <option value='i'>i</option>
        </select>
                {{ csrf_field() }}
				<button id="dia"  type="submit" class="btn btn-primary active">Enviar</button>
        </div>
        </form>
     </section>
@endsection