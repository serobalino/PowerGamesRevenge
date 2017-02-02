<?php

namespace App\Http\Controllers;

use Validator;
use App\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PublicacionesController extends Controller{
    function index(Request $request){
        $validator = Validator::make($request->all(), [
            'id_usr' => 'required',
        ]);
        if ($validator->fails()) {
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $resultado=Publicacion::with('Amigo')->find(Auth::id())->get();
                return $resultado;
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }
    function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_usr'        => 'required',
            'publicacion'   => 'required',
        ]);
        if ($validator->fails()){
            return (['return'=>false,'mensaje'=>'Faltan parametros']);
        }else{
            if(Auth::loginUsingId($request->id_usr,true)){
                $insert = new Publicacion;
                $insert->id             = $request->id_usr;
                $insert->detalle_pub    = $request->publicacion;
                $insert->save();
                return (['return'=>true,'mensaje'=>'😉 Se guardó la Publicación']);
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }
    function show($id){
        if (!$id){
            return (['return'=>false,'mensaje'=>'Faltan parámetros']);
        }else{
            if(Auth::loginUsingId($id,true)){
                $pub_amigos=DB::table('publicaciones')
                    ->leftJoin('amigos','publicaciones.id','=','amigos.use_id')
                    ->leftJoin('users','publicaciones.id','=','users.id')
                    ->leftJoin('megusta','publicaciones.id_pub','=','megusta.id_pub')
                    ->leftJoin('retar','publicaciones.id_pub','=','retar.id_pub')
                    ->select(DB::raw("name,publicaciones.id_pub,publicaciones.id_pub codigo,detalle_pub,megusta.id_pub megu,retar.id_pub reta,(SELECT COUNT(*) FROM megusta WHERE id_pub=codigo) likesn,0 owner"))
                    ->where('amigos.id','=',$id);
                $pub_todas=DB::table('publicaciones')
                    ->leftJoin('users','publicaciones.id','=','users.id')
                    ->leftJoin('megusta','publicaciones.id_pub','=','megusta.id_pub')
                    ->leftJoin('retar','publicaciones.id_pub','=','retar.id_pub')
                    ->select(DB::raw("name,publicaciones.id_pub,publicaciones.id_pub codigo,detalle_pub,megusta.id_pub megu,retar.id_pub reta,(SELECT COUNT(*) FROM megusta WHERE id_pub=codigo) likesn,1 owner"))
                    ->where('publicaciones.id','=',$id)
                    ->union($pub_amigos)
                    ->get();
                return (['return'=>true,'mensaje'=>$pub_todas]);
            }else{
                return (['return'=>false,'mensaje'=>'No ha iniciado sesión']);
            }
        }
    }

    function destroy($id){
        $eliminar = Publicacion::find($id);
        if($eliminar){
            $eliminar->delete();
            return (['return'=>true,'mensaje'=>'😅 Se eliminó correctamente']);
        }else{
            return (['return'=>false,'mensaje'=>'Ha ocurrido un error']);
        }
    }
}
