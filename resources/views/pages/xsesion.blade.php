<!-- Guardado en resources/views/pages/xsesion.blade.php -->

@extends('layouts.principal')

@section('contenido')
  <!--Body content   , 'curso_id' => $curso->id-->
    <form action="{{ action('EvaluacionController@saveXCurso',['profesor_id' => $profesor->id,'curso_id'=> $curso->id, 'catalogoCurso_id'=> $catalogoCurso->id]) }}" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    @if(session()->has('message'))
        <div class="alert alert-success" role='alert' style='text-align:center'>{{session('message')}}</div>
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
                    <div class="form-group row">
                        <div class="col-sm-10">
                        <h4> Participante:  {{ $profesor->nombres }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <h4>Fecha: {{ $curso->getToday() }}</h4>
                        </div>
                    </div>
                    
                    <br>
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
                                <input type="radio" name="p1" value="20" {{ (old('p1') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="40" {{ (old('p1') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="60" {{ (old('p1') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="80" {{ (old('p1') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="100" {{ (old('p1') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="justify">La manera en que el instructor dominó y manejó el tema fue</td>
                        <td align="center">
                            <div class="form-check">
                                    <input type="radio" name="p2" value="20" {{ (old('p2') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="40" {{ (old('p2') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="60" {{ (old('p2') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="80" {{ (old('p2') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p2" value="100" {{ (old('p2') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La claridad en la exposición fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p3" value="20" {{ (old('p3') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="40" {{ (old('p3') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="60" {{ (old('p3') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="80" {{ (old('p3') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p3" value="100" {{ (old('p3') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La habilidad para el manejo de material y recursos didácticos fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p4" value="20" {{ (old('p4') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="40" {{ (old('p4') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="60" {{ (old('p4') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="80" {{ (old('p4') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p4" value="100" {{ (old('p4') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La forma en que se plantearon los problemas o actividades fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p5" value="20" {{ (old('p5') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="40" {{ (old('p5') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="60" {{ (old('p5') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="80" {{ (old('p5') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p5" value="100" {{ (old('p5') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">Los ejemplos utilizados favorecieron la comprensión del tema de una manera</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p6" value="20" {{ (old('p6') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="40" {{ (old('p6') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="60" {{ (old('p6') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="80" {{ (old('p6') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p6" value="100" {{ (old('p6') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <tr>
                        <td align="justify">La forma en que se fomentó la participación grupal fue</td>
                        <td align="center">
                        <div class="form-check">
                                    <input type="radio" name="p7" value="20" {{ (old('p7') == '20') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="40" {{ (old('p7') == '40') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="60" {{ (old('p7') == '60') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="80" {{ (old('p7') == '80') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                            <td align="center">
                                <div class="form-check">
                                    <input type="radio" name="p7" value="100" {{ (old('p7') == '100') ? 'checked' : '' }} class="form-check-input" id="materialUnchecked">
                                </div>
                            </td>
                    </tr>
                    <table class="table table-hover">
                        <tr>
                            <td width="40%" align="justify">De los contenidos abordados. ¿Cuáles considera que puede incorporar a su práctica docente?</td>
                            <td><textarea name="contenido" class="form-control" id="contenido" rows="2"></textarea></td>
                        </tr>
                        <tr>
                            <td width="40%" align="justify">Comentarios y Sugerencias</td>
                            <td><textarea name="sug" class="form-control" id="sug" rows="2"></textarea></td>
                        </tr>
                    </table>
                    </table>
                    <div class="form-group">
						{{ csrf_field() }}
                        <button type="submit" class="btn btn-primary active">Enviar evaluación</button>
                    </div>
                </div>
    
     </section>
     <br>
     </form>
@endsection