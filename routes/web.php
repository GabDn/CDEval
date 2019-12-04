<?php
Route::get('/', function () {

    //return view('layouts.principal');
    return view('welcome');
});

Route::post('/autentificar', "AutentificarController@index")->name("autentificar");

//Guardar evaluaciones en la BD
Route::get('evaluar/{profesor_id}/{curso_id}/{catalogoCurso_id}','EvaluacionController@index')->name('evaluacion.index');
Route::get('evaluarSesion/{profesor_id}/{curso_id}/{catalogoCurso_id}/{count}','EvaluacionController@evaluacionPorSesion')->name('evaluacion.porSesion');
Route::get('evaluarCurso/{profesor_id}/{curso_id}/{catalogoCurso_id}/{count}','EvaluacionController@evaluacionPorCurso')->name('evaluacion.porCurso');

Route::post('evaluar/finalc',"EvaluacionController@saveFinal_Curso")->name('final.curso');
Route::post('/finals','EvaluacionController@saveFinal_Seminario')->name('final.seminario');
Route::post('evaluar/xcurso',"EvaluacionController@saveXCurso")->name('x.curso');
Route::post('evaluar/xseminario',"EvaluacionController@saveXSeminario")->name('x.seminario');

