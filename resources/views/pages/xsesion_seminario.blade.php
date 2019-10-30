<!-- Guardado en resources/views/pages/xsesion.blade.php -->
@extends('layouts.principal')

@section('contenido')
<form action="{{ action('EvaluacionController@saveXSeminario') }}" method="POST">
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
                    <h2><span class="fa fa-check-square-o"></span>    Evaluación por sesión de seminario </h3>
                </div>

                <div class="panel-body">
                    <br>
                    <div class="form-group row">
                        <label for="staticCurso" class="col-sm-2 col-form-label">Nombre del seminario</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="curso" value="Nombre Curso">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticFacilitador" class="col-sm-2 col-form-label">Nombre del facilitador del seminario</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="facilitador" value="Nombre Facilitador">
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
                        <th width="42%">ASPECTOS A EVALUAR. MARQUE LA OPCIÓN QUE REPRESENTE A SU PARECER, EL DESARROLLO DEL TRABAJO EN LA SESIÓN</th>
                        <th align="float-right"></th>
                        <th align="float-right">ARGUMENTE</th>
                    </tr>
                    <tr>
                        <td align="justify">1. Se presentó una orden del día </td>
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p1" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p1" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p1_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                        
                        
                    </tr>
                    <tr>
                        <td align="justify">2. El o los objetivos del seminario son los esperados por el grupo </td>
                       
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p2" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p2" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p2_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td align="justify">3. El moderador centró el desarrollo de la sesión </td>
                        
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p3" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p3" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p3_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td align="justify">4. Se propició la participación de todos los asistentes </td>
                       
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p4" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p4" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p4_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                       
                    </tr>
                    <tr>
                        <td align="justify">5. Se levantó una minuta de sesión </td>
                       
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p5" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p5" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p5_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td align="justify">6. Se obtuvieron conclusiones </td>
                       
                        <td align="center">
                            <div class="form-check">
                                <input type="radio" name="p6" value="1" class="form-check-input" id="materialUnchecked"> Sí
                                &nbsp;
                                <input type="radio" name="p6" value="1" class="form-check-input" id="materialUnchecked"> No
                            </div>
                        </td>
                        <td><textarea name="p6_arg" class="form-control" id="sugerencias" rows="2"></textarea></td>
                        
                    </tr>
                    
            </table>
                <div class="form-group">
                            <button type="submit" class="btn btn-primary active">Enviar evaluación</button>
                        </div>
    </div>
     </section>
    <br>
    </form>
@endsection