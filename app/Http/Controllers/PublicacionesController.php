<?php

namespace App\Http\Controllers;

use App\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicacionesController extends Controller{
    public function show($id){

        $user   = Auth::user();
        $id_us  =   $user->id;
        return Publicacion::where('id','=',$id_us)->where('id_pub','=',$id);
    }

    public function index(){


        $user   =   Auth::user()->id;
        $id_us  =   $user->id;
        return Publicacion::find($id_us)->get();
    }

    ///ingresa un nuevo cliente
    public function store(Request $request){
        $user   = Auth::user();
        $id_us  =   $user->id;

        $reglas = [
            'detalle'    =>  'required|min:10',

        ];
        try {
            $validacion = Validator::make($request->all(), $reglas);
            if ($validacion->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validacion->errors()->all()
                ];
            }
            $publicacion = new Publicacion;
            $publicacion->detalle_pub   =   $request->detalle;
            $publicacion->id            =   $id_us;

            $publicacion->save();
            return ['created' => true];
        } catch (Exception $e) {
            return \Response::json(['created' => false]);
        }
    }

}
