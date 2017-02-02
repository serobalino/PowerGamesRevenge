<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;
use Unirest\Request;


class APIJuegosController extends Controller{

    private function juegoWS($parametro){
        $response = Request::get("https://igdbcom-internet-game-database-v1.p.mashape.com/games/?fields=*&limit=10&offset=0&order=release_dates.date%3Adesc&search=$parametro",
            [
                "X-Mashape-Key" => "JgZPtQQAeVmsh5onCixC9uYpQqjTp1rjkh1jsnFwl0cpbRG1Xg",
                "Accept" => "application/json"
            ]
        );
        return($response->body);
    }
    private function generoWS($parametro){
        $valor='';
        if($parametro)
            $valor="&search=$parametro";
        $response = Request::get("https://igdbcom-internet-game-database-v1.p.mashape.com/genres/?fields=*&limit=40$valor",
            [
                "X-Mashape-Key" => "JgZPtQQAeVmsh5onCixC9uYpQqjTp1rjkh1jsnFwl0cpbRG1Xg",
                "Accept" => "application/json"
            ]
        );
        return($response->body);
    }
    private function capturasWS(){
        $response = Request::get("https://igdbcom-internet-game-database-v1.p.mashape.com/pulses/?fields=*",
            [
                "X-Mashape-Key" => "JgZPtQQAeVmsh5onCixC9uYpQqjTp1rjkh1jsnFwl0cpbRG1Xg",
                "Accept" => "application/json"
            ]
        );
        $regreso=collect($response->body)->shuffle();
        return($regreso);
    }
    function index(){

    }
    function carusel(){
        return($this->capturasWS());
    }
}
