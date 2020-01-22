@extends('layouts.app')

@section('contenido')

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
              {!! Form::open(["route" => "buscar.curso", "method" => "GET"]) !!}
              <div class="input-group">
                  {!!Form::text("pattern", null, [ "class" => "form-control", "placeholder" => "Buscar Curso"])!!}
                  {!! Form::select('type', array(
                         'nombre' => 'Por nombre',
                         'instructor' => 'Por instructor',
                         'semestre' => 'Por semestre'),
                         null,['class' => 'btn dropdown-toggle pull-left'] ) !!}
                  {!! Form::close() !!}
                  <span class="input-group-btn col-md-2">
                      <button class="btn btn-search " type="submit">Buscar</button>
                   </span>
              </div>
          </div>

                <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Instructor</th>
                                    <th>Semestre</th>
                                    <th>Evaluación</th>
                                </tr>
                            </thead>
                            @foreach($cursos as $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso->getNombreCurso() }}</td>
                                    <td>{{ $curso->getProfesores2() }}</td>
                                    <td>{{ $curso->semestre_anio }}-{{ $curso->semestre_pi }}{{ $curso->semestre_si }}</td>
                                    <td>
                                    <a href="#" class="btn btn-warning">Sesión</a>
                                    <a href="#" class="btn btn-success">Global</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>   
                </div>
     </section>
@endsection