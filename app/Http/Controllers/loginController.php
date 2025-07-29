<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class loginController extends Controller
{
    public function index(){
        if(Auth::check()){
        return redirect()->route('panel');
        }
        return view('auth.login');
    }


    public function login(loginRequest $request)
    {

        //Validaciones credenciales
        if(!Auth::validate($request->only('email','password'))){
            return redirect()->to('login')->withErrors('El usuario o la contraseña no son correctos. Inténtalo de nuevo.');
            
        }

        //crea una sesion 
        $user = Auth::getProvider()->retrieveByCredentials($request->only('email','password'));
        Auth::login($user);

        return redirect()->route('panel')->with('success', 'Bienvenido '.$user->name);  
    }
}



