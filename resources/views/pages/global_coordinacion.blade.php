
@extends('layouts.app')

@section('contenido')
  <!--Body content-->

<form method="POST" action="{{ action('CoordinadorController@enviarCoordinacion')}}">
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
                <h3> Curso:  Seleccione semestre</h3>
            </div>
            <div class="panel-body">
                <select name='semestre' width="25%">
                <?php 
                    foreach($fechas as $fecha){
                        echo "<option value=$fecha>$fecha</option>";
                    }
                ?>
                </select>
                <br>
                <select name='coordinacion' width="25%">
                <?php 
                    foreach($coordinaciones as $coordinacion){
                        echo "<option value=$coordinacion->abreviatura>$coordinacion->nombre_coordinacion</option>";
                    }
                ?>
				        </select>
				{{ csrf_field() }}
				<button id="dia"  type="submit" class="btn btn-primary active">Enviar</button>
            </div>
     </section>
	 </div>
  </div>	
</form>
<br>
<br>	
@endsection