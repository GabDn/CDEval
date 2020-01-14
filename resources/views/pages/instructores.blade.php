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
                    <h3>Instructores</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <form class="form-inline md-form form-sm mt-0">
                                <select class="mdb-select md-form colorful-select dropdown-primary" searchable="Search here..">
                                        <option value="1">Nombre</option>
                                        <option value="2">Apellido</option>
                                        <option value="3">Curso</option>
                                </select>
                                <form class="form-inline">
                                    <input class="form-control mr-sm-2" type="text" /> 
                                    <button class="btn btn-primary " type="submit">
                                        Buscar
                                    </button>
                                </form>
                            </form>
                    </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Instructor</th>
                                    <th>Curso</th>
                                    <th>Semestre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hugo Salazar</td>
                                    <td>Python</td>
                                    <td>2020-1</td>
                                </tr>
                            </tbody>
                        </table>   
                </div>
     </section>
@endsection