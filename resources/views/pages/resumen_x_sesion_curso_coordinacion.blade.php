<!-- Guardado en resources/views/pages/xsesion.blade.php -->
@extends('layouts.coordinadores')

@section('contenido')
  <!--Body content   , 'curso_id' => $curso->id-->
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
  <div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>
   
    <section class="content-inner">
    
      <div class="panel panel-default">
      @if(session()->has('msj'))
        <div class="alert alert-success" role='alert'>{{session('msj')}}</div>
      @endif
                <div class="panel-heading">
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de curso </h3>
                </div>

                <div class="panel-body">
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <h4> Curso:  {{ $curso->getNombreCurso() }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-sm-10">
                                <h4>Instructor: {{ $curso->getProfesores() }}</h4>
                            </div> 
                    </div>
                    
                    <br>
                    <table class="table table-hover">
                    <tr>
                        <th align="justify" colspan="3">La forma en la que se alcanzaron los objetivos planteados fue </th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p1) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <th align="justify" colspan="3">La manera en que el instructor dominó y manejó el tema fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p2) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify" colspan="3">La claridad en la exposición fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch($evals[1]->p3){
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>       
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify" colspan="3">La habilidad para el manejo de material y recursos didácticos fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p4) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify" colspan="3">La forma en que se plantearon los problemas o actividades fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p5) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify" colspan="3">Los ejemplos utilizados favorecieron la comprensión del tema de una manera</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p6) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify" colspan="3">La forma en que se fomentó la participación grupal fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                $nombre = $evals[0]->nombres.' '.$evals[0]->apellido_paterno.' '.$evals[0]->apellido_materno;
                                switch ($evals[1]->p7) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">$nombre</td>";
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <br>
                    <table class="table table-hover">
                        <tr>
                            <th width="40%" align="justify" colspan="2">De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</th>
                            @foreach($evaluaciones as $evals)
                                <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:left;">{{$evals[1]->contenido}}</td>
                                </tr>
                            @endforeach
                        </tr>
                        <tr></tr>
                        <tr>
                            <th width="40%" align="justify" colspan="2">Comentarios y Sugerencias</th> 
                            @foreach($evaluaciones as $evals)
                                <tr>
                                <td style="text-align:left;">{{$evals[0]->nombres}} {{$evals[0]->apellido_paterno}} {{$evals[0]->apellido_materno}}</td>
                                <td style="text-align:left;">{{$evals[1]->sug}}</td>
                                </tr>
                            @endforeach
                        </tr>
                    </table>
                    </table>
                    <div class="form-group">
						{{ csrf_field() }}
                        <button type="submit" class="btn btn-primary active"><a href="{{route('ver.sesion.final',['curso_id'=>$curso_id,'pdf'=>1,'encargado_id'=>$encargado_id])}}" style="color:white">Descargar</a></button>
                    </div>
                </div>
    
     </section>
     <br>
@endsection