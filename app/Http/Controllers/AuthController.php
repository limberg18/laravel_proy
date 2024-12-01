<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function   funcLogin(Request $request)
    {

        $credenciales = $request->validate([
            'email' => "required|email",
            'password' => 'required'
        ]);

        if (!Auth::attempt($credenciales)) {
            return response()->json(["ms" => "credenciales incorrectas"]);
        }
        //generamos token
        $token = $request->user()->createToken("token auth")->plainTextToken;

        return response()->json([
            "access_token" => $token,
            "usuario" => $request->user(),
        ], 201);
    }
    public function funcRegister(Request $request) {

        $credenciales = $request->validate([
            'name'=>"required",
            'email' => "required|email",
            'password' => 'required|same:c_password',

        ]);

        $usuario= new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=$request->password;
        $usuario->save();

        return response()->json(["ms"=>"usuario regsitrado"],201);


    }
    public function funcProfile(Request $request) {

        $usuario= $request->user();
        return response()->json($usuario,200);

    }
    public function funcLogout(Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(["ms"=>"Logout"],201);
    }

  
}
