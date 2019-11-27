<!-- Guardado en resources/views/pages/xsesion.blade.php -->

@extends('layouts.principal')

@section('contenido')
  <!--Body content-->
    <form action="{{ action('EvaluacionController@saveXCurso') }}" method="POST">
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
                <div class="panel-heading">
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de curso </h3>
                </div>

                <div class="panel-body">
                    <br>
                    <div class="form-group row">
                        <label for="staticCurso" class="col-sm-2 col-form-label">Nombre del curso</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="curso" value="Nombre Curso">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticParticipante" class="col-sm-2 col-form-label">Nombre del participante</label>
                        <div class="col-md-10">
                            <input type="text" readonly class="form-control-plaintext" id="participante" value="Nombre Participante">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticInstructor" class="col-sm-2 col-form-label">Nombre del instructor</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="instructor" value="Nombre Instructor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticFecha" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="fecha" value="fecha">
                        </div>
                    </div>

                    <table class="table table-hover">
                    <tr>
                        <th width="42%" align="justify">ASPECTOS A EVALUAR. MARQUE LA OPCIÓN QUE REPRESENTE A SU PARECER, EL DESARROLLO DEL TRABAJO EN LA SESIÓN</th>
                        <th align="right">Mala</th>
                        <th align="right">Regular</th>
                        <th align="right">Buena</th>
                        <th align="right">Muy buena</th>
                        <th align="right">Excelente</th>
                    </tr>
                    <tr>
                        <td align="justify">La forma en la que se alcanzaron los objetivos planteados fue </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="1" class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="2" class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="3" class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="4" class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="5" class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">La manera en que el instructor dominó y manejó el tema fue</td>
                        <td align="center">
                            <div class="form-check">
                                    <input type="radio" name="p2" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La claridad en la exposición fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p3" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La habilidad para el manejo de material y recursos didácticos fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p4" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La forma en que se plantearon los problemas o actividades fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p5" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">Los ejemplos utilizados favorecieron la comprensión del tema de una manera</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p6" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La forma en que se fomentó la participación grupal fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p7" value="1" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="2" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="3" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="4" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="5" class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <table class="table table-hover">
                        <tr>
                            <td width="40%" align="justify">De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</td>
                            <td><textarea class="form-control" id="contenido" rows="2"></textarea></td>
                        </tr>
                        <tr>
                            <td width="40%" align="justify">Comentarios y Sugerencias</td>
                            <td><textarea class="form-control" id="sugerencias" rows="2"></textarea></td>
                        </tr>
                    </table>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary active">Enviar evaluación</button>
                    </div>
                </div>
    
     </section>
     <br>
     </form>
@endsection