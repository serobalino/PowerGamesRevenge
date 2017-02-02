<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller{
    public function postLogin(Request $request){
        $variable = false;
        if (Auth::once(
            [
                'email'     => $request->email,
                'password'  => $request->password,
            ]
            , $request->has('remember')
        )){
            //Auth::loginUsingId(Auth::user()->id, true);

            if (Auth::check()) {
                $variable = true;
            }
            return (
                [
                    'id'        =>Auth::user()->id,
                    'session'   =>$variable,
                    'mesanje'   =>'Credenciales correctos'
                ]);
        }else{
            return (
                [
                    'session'   =>$variable,
                    'mesanje'   =>'Los campos no coinciden'
                ]);
        }
    }
}
