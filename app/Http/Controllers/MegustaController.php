<?php

namespace App\Http\Controllers;

use Validator;
use App\Megusta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class MegustaController extends Controller{
    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_usr'   => 'required',
            'id_pub'   => 'required',
        ]);
        if ($validator->fails()){
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $select = Megusta::where('id',$request->id_usr)->where('id_pub',$request->id_pub)->first();
                if(count($select)){
                    Megusta::where('id',$request->id_usr)->where('id_pub',$request->id_pub)->delete();
                    return (['return'=>true,'mensaje'=>'😤 Quitaste un Me gusta']);
                }else{
                    $insert = new Megusta;
                    $insert->id        = $request->id_usr;
                    $insert->id_pub    = $request->id_pub;
                    //$insert->fecha_me  = Carbon::now();
                    $insert->save();
                    return (['return'=>true,'mensaje'=>'😀 Diste un Me gusta']);
                }
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }
}
