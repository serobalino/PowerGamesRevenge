<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller{
    public function postLogin(Request $request){
        if (Auth::attempt(
            [
                'email'     => $request->email,
                'password'  => $request->password,
            ]
            , $request->has('remember')
        )){
            return (
                [
                    'id'        =>Auth::user()->id,
                    'session'   =>true,
                    'mesanje'   =>'Credenciales correctos'
                ]);
        }else{
            return (
                [
                    'session'   =>false,
                    'mesanje'   =>'Los campos no coinciden'
                ]);
        }
    }
}
