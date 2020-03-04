<?php
Route::get('/', function () {

    //return view('layouts.principal');
    return view('welcome');
});

Route::post('/autentificar', "AutentificarController@index")->name("autentificar");
//Vista de coordinador
//Route::post('/coordinador', "AutentificarController@index")->name("coordinador");
Route::get('/cursos',"CoordinadorController@cursos")->name("cursos");
Route::get('/instructores',"CoordinadorController@instructores")->name("instructores");
Route::get('cursos/buscar',"CoordinadorController@searchCursos")->name("buscar.curso");
Route::get('sesion',"CoordinadorController@sesiones")->name("ver.sesion");
Route::get('global',"CoordinadorController@globales")->name("ver.global");
//Para enviar correos
Route::get('evaluarCurso/{profesor_id}/{curso_id}','EvaluacionController@enviarCorreo')->name('evaluacion.correo');
//Guardar evaluaciones en la BD
Route::get('evaluar/{profesor_id}/{curso_id}/{catalogoCurso_id}','EvaluacionController@index')->name('evaluacion.index');
Route::get('evaluarSesion/{profesor_id}/{curso_id}/{catalogoCurso_id}/{count}','EvaluacionController@evaluacionPorSesion')->name('evaluacion.porSesion');
Route::get('evaluarCurso/{profesor_id}/{curso_id}/{catalogoCurso_id}/{count}','EvaluacionController@evaluacionPorCurso')->name('evaluacion.porCurso');

Route::post('evaluar/finalc/{profesor_id}/{curso_id}/{catalogoCurso_id}',"EvaluacionController@saveFinal_Curso")->name('final.curso');
Route::post('/finals/{profesor_id}/{curso_id}','EvaluacionController@saveFinal_Seminario')->name('final.seminario');
Route::post('evaluar/xcurso/{profesor_id}/{curso_id}/{catalogoCurso_id}',"EvaluacionController@saveXCurso")->name('x.curso');
Route::post('evaluar/xseminario/{profesor_id}/{curso_id}',"EvaluacionController@saveXSeminario")->name('x.seminario');

Route::get('enviar/{profesor_id}',"EvaluacionController@enviarClaveCrusoHistorico")->name('evaluacion.enviarClaveCrusoHistorico');
Route::get('enviarFecha/{profesor_id}',"EvaluacionController@redirigirAEnviar")->name('evaluacion.enviarClaveFecha');
Route::post('enviarFechaArchivo/{profesor}',"EvaluacionController@enviarClaveFecha")->name('evaluacion.enviarClaveFechaArchivo');
Route::get('admin/{profesor_id}',"EvaluacionController@admin")->name('evaluacion.admin');


