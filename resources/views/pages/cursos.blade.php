@extends($layout)

@section('contenido')

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
            <h3>Cursos</h3>
            <h4>Periodo</h4>
            <div class="row">
                <form action="{{route('cursos.coordinacion',['encargado_id'=>$encargado_id,'message'=>$message])}}">
                    <div class="form-group">
                        <div class="col-md-4"><input class="form-control" type="text" name="periodo_anio" placeholder="Periodo" value="{{isset($periodo_anio)? $periodo_anio:null}}"></div>
                        <div class="col-md-2"><select class="form-control" name="periodo_pi">
                            @if (isset($periodo_pi) && $periodo_pi == '1')
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            @else
                            <option value="1">1</option>
                            <option value="2" selected>2</option>
                            @endif
                        </select></div>
                        <div class="col-md-2"><select class="form-control" name="periodo_si">
                            @if (isset($periodo_si) && $periodo_si == 's')
                            <option value="s" selected>s</option>
                            <option value="i">i</option>
                            @else
                            <option value="s">s</option>
                            <option value="i" selected>i</option>
                            @endif
                        </select></div>
                        <div class="col-md-4"><button type="submit" class="btn btn-info">Cambiar periodo</button></div>
                    </div>
                </form>
            </div>
            <hr>
            <h4>Buscar</h4>
            {!! Form::open(["route" => ["buscar.curso",$encargado_id,$message], "method" => "GET"]) !!}
              <div class="input-group">
                  {!!Form::text("pattern", null, [ "class" => "form-control", "placeholder" => "Buscar Curso"])!!}
                  {!! Form::select('type', array(
                         'nombre' => 'Por nombre',
                         'instructor' => 'Por instructor'),
                         null,['class' => 'btn dropdown-toggle pull-left'] ) !!}
                
                  <span class="input-group-btn col-md-2">
                    <button class="btn btn-search " type="submit">Buscar</button>
                </span>
                <input type="hidden" name="periodo_anio" value="{{isset($periodo_anio)? $periodo_anio:null}}">
                <input type="hidden" name="periodo_pi" value="{{isset($periodo_pi)? $periodo_pi:null}}">
                <input type="hidden" name="periodo_si" value="{{isset($periodo_si)? $periodo_si:null}}">
              </div>
            {!! Form::close() !!}
          </div>

                <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Instructor(es)</th>
                                    <th>Periodo</th>
                                    <th>Evaluación</th>
                                    <th>Evaluar</th>
                                </tr>
                            </thead>
                            @foreach($cursos as $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso[1]->nombre_curso }}</td>
                                    <td>
                                    @foreach($curso[2] as $profesors)
                                        @foreach($profesors as $profesor)
                                         <p>{{ $profesor->nombres }} {{$profesor->apellido_paterno}} {{$profesor->apellido_materno}} </p>
                                        @endforeach
                                    @endforeach
                                    </td>
                                    <td>{{ $curso[0]->semestre_anio }}-{{ $curso[0]->semestre_pi }}{{ $curso[0]->semestre_si }}</td>
                                    <td>
                                    <a href="{{ route('ver.sesion.final',['curso_id'=>$curso[0]->id,'pdf'=>0,'encargado_id'=>$encargado_id]) }}" class="btn btn-warning">Sesión</a>
                                    <a href="{{ route('ver.global.final',['curso_id'=>$curso[0]->id,'pdf'=>0,'encargado_id'=>$encargado_id]) }}" class="btn btn-success">Final</a>
                                    </td>
                                    <td><a href="{{ route('realizar.evaluaciones',['encargado_id'=>$encargado_id,'curso_id'=>$curso[0]->id]) }}" class="btn btn-primary">Evaluar</a></td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>   
                </div>
     </section>
@endsection