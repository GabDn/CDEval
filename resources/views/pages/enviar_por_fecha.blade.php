@extends('layouts.principal')

@section('contenido')
<form method="POST" action="{{ action('EvaluacionController@enviarClaveFecha',[ $profesor->id] ) }}">
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
					<option value="2020-2">2020-2</option>
					<option value="2020-1">2020-1</option>
					<option value="2019-2">2019-2</option>
					<option value="2019-1">2019-1</option>
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