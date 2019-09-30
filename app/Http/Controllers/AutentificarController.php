<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\Http\Controllers\Controller;

class AutentificarController extends Controller{


     public function index(Request $request){
        $profesores = Profesor::all();
        //return $profesores;

        foreach($profesores as $profesor){
            if ($profesor->rfc == $request->rfc) {
                //El profesor está en la BD
                if ($profesor->numero_trabajador == $request->numTrabajador) {
                    //El profesor está en la BD y las credenciales son correctas
                    return view("pages.xsesion")
                    ->with("profesor",$profesor);
                            
                } else {
                    return "El profesor está en la bd pero el número de trabajador está mal";
                }
            }else{
                return "El profesor no está en la BD";
            }
            
        }

     }

}
