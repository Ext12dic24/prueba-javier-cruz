<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwUsuarios;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function registro(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:45',
            'email' => 'required|string|email||max:45|unique:App\Models\TwUsuarios',
            'password' => 'required|string|max:100',
            'S_Nombre' => 'nullable|string|max:45',
            'S_Apellidos' => 'nullable|string|max:45',
            'S_FotoPerfilUrl' => 'nullable|string|max:255',
        ]);

        try{
            $usuario = new TwUsuarios();
            $usuario->username = $request->username;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->S_Nombre = $request->S_Nombre;
            $usuario->S_Apellidos = $request->S_Apellidos;
            $usuario->S_FotoPerfilUrl = $request->S_FotoPerfilUrl;
            $usuario->S_Activo = 1;
            $usuario->verified = "";
            $usuario->save();


            return response()->json([
                'respuesta' => 'Se ha creado correctamente el usuario'
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
            ], 400);
        }
        
    }

    public function entrar(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'respuesta' => 'Inicio de sesión no valido'
            ], 401);

        try{
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
    
            $token = $tokenResult->token;
            $token->save();
    
            return response()->json([
                'respuesta' => 'Inicio de sesión correcto',
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ]);

        }catch(\Exception $e){
            return response()->json([
                'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
            ], 400);
        }
        
    }

    public function salir(Request $request)
    {
        try{
            $request->user()->token()->revoke();

            return response()->json([
                'respuesta' => 'Cierre de sesión exitoso'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
            ], 400);
        }
    }
}
