<!-- Guardado en resources/views/pages/xsesion.blade.php -->

@extends('layouts.app')

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
                        <h4> Curso:  {{ $catalogoCurso->nombre_curso }}</h4>
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
                        <th align="justify">La forma en la que se alcanzaron los objetivos planteados fue </th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p1) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr>
                        <th align="justify">La manera en que el instructor dominó y manejó el tema fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p2) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify">La claridad en la exposición fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch($evals->p3){
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>       
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify">La habilidad para el manejo de material y recursos didácticos fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p4) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify">La forma en que se plantearon los problemas o actividades fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p5) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify">Los ejemplos utilizados favorecieron la comprensión del tema de una manera</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p6) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
                                        echo "<td style=\"text-align:left;\">Mala</td>";
                                        break;
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                    <tr></tr>
                    <tr>
                        <th align="justify">La forma en que se fomentó la participación grupal fue</th>
                        <?php 
                            foreach($evaluaciones as $evals){
                                echo "<tr>";
                                switch ($evals->p7) {
                                    case 100:
                                        echo "<td style=\"text-align:left;\">Excelente</td>";
                                        break;
                                    case 80:
                                        echo "<td style=\"text-align:left;\">Muy Buena</td>";
                                        break;
                                    case 60:
                                        echo "<td style=\"text-align:left;\">Buena</td>";
                                        break;
                                    case 40:
                                        echo "<td style=\"text-align:left;\">Regular</td>";
                                        break;
                                    case 20:
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
                            <th width="40%" align="justify">De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</th>
                            <?php 
                                foreach($evaluaciones as $evals){
                                    echo "<tr>";
                                    echo "<td style=\"text-align:left;\">$evals->contenido</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tr>
                        <tr></tr>
                        <tr>
                            <th width="40%" align="justify">Comentarios y Sugerencias</th>
                            <?php 
                                foreach($evaluaciones as $evals){
                                    echo "<tr>";
                                    echo "<td style=\"text-align:left;\">$evals->sug</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tr>
                    </table>
                    </table>
                    <div class="form-group">
						{{ csrf_field() }}
                        <button type="submit" class="btn btn-primary active"><a href="{{route('ver.sesion.final',['curso_id'=>$curso_id,'pdf'=>1])}}" style="color:white">Descargar</a></button>
                    </div>
                </div>
    
     </section>
     <br>
@endsection