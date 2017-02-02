<?php

namespace App\Http\Controllers;

use Validator;
use App\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Unirest;

class JuegosController extends Controller
{
    function index(Request $request){
        $validator = Validator::make($request->all(), [
            'id_usr' => 'required',
        ]);
        if ($validator->fails()) {
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $resultado=Juego::where('id',$request->id_usr)->get();
                foreach ($resultado as $api) {
                    $vector['id_ju']   =$api->id_ju;
                    $vector['id']       =$api->id;
                    $vector['titulo_ju']=$api->titulo_ju;
                    $vector['estado_ju']=$api->estado_ju;
                    $res=$this->juegoWS($api->titulo_ju,$api->id_ju);
                    $vector['api']   =$res;
                    $resultadoAPI[]=$vector;
                }
                if(count($resultado))
                    return (['return'=>true,'mensaje'=>$resultadoAPI]);
                else
                    return (['return'=>true,'mensaje'=>'No tienes juegos registrados']);


            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }

    }
    function show(Request $request,$titulo){
        $validator = Validator::make($request->all(), [
            'id_usr' => 'required',
        ]);
        if ($validator->fails()) {
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $resultado=$this->juegoWSNombre($titulo);
                if(count($resultado))
                    return (['return'=>true,'mensaje'=>$resultado]);
                else
                    return (['return'=>true,'mensaje'=>'No hay resultados']);
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }
    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_usr' => 'required',
            'id_jue' => 'required',
            'titulo' => 'required',
        ]);
        if ($validator->fails()) {
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $insert = new Juego;
                $insert->id         = $request->id_usr;
                $insert->id_ju      = $request->id_jue;
                $insert->titulo_ju  = $request->titulo;
                $insert->estado_ju  = true;
                $insert->save();
                return (['return'=>true,'mensaje'=>'Se guardo correctamente']);
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }

    private function juegoWS($parametro,$idjuego){
        $response = Unirest\Request::get("https://igdbcom-internet-game-database-v1.p.mashape.com/games/?fields=*&limit=10&offset=0&order=release_dates.date%3Adesc&search=$parametro",
            [
                "X-Mashape-Key" => "JgZPtQQAeVmsh5onCixC9uYpQqjTp1rjkh1jsnFwl0cpbRG1Xg",
                "Accept" => "application/json"
            ]
        );
        $regreso=$response->body;
        $parseado=collect($regreso)->where('id',$idjuego);
        //$parseado=collect($parseado)->only(['screenshots', 'cover']);
        return($parseado);
    }
    private function juegoWSNombre($parametro){
        $response = Unirest\Request::get("https://igdbcom-internet-game-database-v1.p.mashape.com/games/?fields=*&limit=20&offset=0&order=release_dates.date%3Adesc&search=$parametro",
            [
                "X-Mashape-Key" => "JgZPtQQAeVmsh5onCixC9uYpQqjTp1rjkh1jsnFwl0cpbRG1Xg",
                "Accept" => "application/json"
            ]
        );
        $regreso=$response->body;

        return($regreso);
    }
}
