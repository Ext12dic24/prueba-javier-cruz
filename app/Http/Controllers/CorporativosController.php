<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwCorporativos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CorporativosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'S_NombreCorto' => 'required|string|max:45',
            'S_NombreCompleto' => 'required|string|max:75',
            'S_LogoURL' => 'nullable|string|max:255',
            'S_DBName' => 'required|string|max:45',
            'S_DBUsuario' => 'required|string|max:45',
            'S_DBPassword' => 'required|string|max:150',
            'S_SystemUrl' => 'required|string|max:255',
            'tw_usuarios_id' => 'required|numeric',
        ]);

        try{
            $entidad = new TwCorporativos();
            $entidad->S_NombreCorto = $request->S_NombreCorto;
            $entidad->S_NombreCompleto = $request->S_NombreCompleto;
            $entidad->S_LogoURL = $request->S_LogoURL;
            $entidad->S_DBName = $request->S_DBName;
            $entidad->S_DBUsuario = $request->S_DBUsuario;
            $entidad->S_DBPassword = $request->S_DBPassword;
            $entidad->S_SystemUrl = $request->S_SystemUrl;
            $entidad->S_Activo = 1;
            $entidad->D_FechaIncorporacion = Carbon::now();
            $entidad->tw_usuarios_id = $request->tw_usuarios_id;
            $entidad->save();


            return response()->json([
                'respuesta' => 'Se ha creado correctamente el nuevo registro'
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
            ], 400);
        }
    }

    public function read1(Request $request)
    {
        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwCorporativos::find($request->id)){
            return response()->json([
                'respuesta' => 'Se ha recuperado la información del registro',
                'datos' => $res
            ], 200);
        }else{
            return response()->json([
                'respuesta' => 'No se ha podido encontrar ninguna coincidencia para el registro con id: ' . $request->id
            ], 404);
        }
    }

    public function read2(Request $request)
    {
        $res = TwCorporativos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'S_NombreCorto' => 'required|string|max:45',
            'S_NombreCompleto' => 'required|string|max:75',
            'S_LogoURL' => 'nullable|string|max:255',
            'S_DBName' => 'required|string|max:45',
            'S_DBUsuario' => 'required|string|max:45',
            'S_DBPassword' => 'required|string|max:150',
            'S_SystemUrl' => 'required|string|max:255',
            'tw_usuarios_id' => 'required|numeric',
            'S_Activo' => 'required|numeric',
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwCorporativos::find($request->id)){
            try{
                $res->S_NombreCorto = $request->S_NombreCorto;
                $res->S_NombreCompleto = $request->S_NombreCompleto;
                $res->S_LogoURL = $request->S_LogoURL;
                $res->S_DBName = $request->S_DBName;
                $res->S_DBUsuario = $request->S_DBUsuario;
                $res->S_DBPassword = $request->S_DBPassword;
                $res->S_SystemUrl = $request->S_SystemUrl;
                $res->S_Activo = $request->S_Activo;
                $res->tw_usuarios_id = $request->tw_usuarios_id;
                $res->save();

                return response()->json([
                    'respuesta' => 'Se han actualizado los datos del registro',
                    'datos' => $res
                ], 200);

            }catch(\Exception $e){
                return response()->json([
                    'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
                ], 400);
            }

        }else{
            return response()->json([
                'respuesta' => 'No se ha podido encontrar ninguna coincidencia para el registro con id: ' . $request->id
            ], 404);
        }
    }

    public function delete(Request $request)
    {
        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwCorporativos::find($request->id)){
            try{
                $res->delete();

                return response()->json([
                    'respuesta' => 'Se ha borrado el registro correctamente'
                ], 200);

            }catch(\Exception $e){
                return response()->json([
                    'respuesta' => 'Ha ocurrido un error durante la operación: ' . $e->getMessage()
                ], 400);
            }

        }else{
            return response()->json([
                'respuesta' => 'No se ha podido encontrar ninguna coincidencia para el registro con id: ' . $request->id
            ], 404);
        }
    }
}
