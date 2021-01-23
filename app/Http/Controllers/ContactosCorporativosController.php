<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwContactosCorporativos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactosCorporativosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'S_Nombre' => 'required|string|max:45',
            'S_Puesto' => 'required|string|max:45',
            'S_Comentarios' => 'nullable|string|max:255',
            'N_TelefonoFijo' => 'nullable|string|max:12',
            'N_TelefonoMovil' => 'nullable|string|max:12',
            'S_Email' => 'required|string|max:45',
            'tw_corporativos_id' => 'required|numeric',
        ]);

        try{
            $entidad = new TwContactosCorporativos();
            $entidad->S_Nombre = $request->S_Nombre;
            $entidad->S_Puesto = $request->S_Puesto;
            $entidad->S_Comentarios = $request->S_Comentarios;
            $entidad->N_TelefonoFijo = $request->N_TelefonoFijo;
            $entidad->N_TelefonoMovil = $request->N_TelefonoMovil;
            $entidad->S_Email = $request->S_Email;
            $entidad->tw_corporativos_id = $request->tw_corporativos_id;
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

        if($res = TwContactosCorporativos::find($request->id)){
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
        $res = TwContactosCorporativos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'S_Nombre' => 'required|string|max:45',
            'S_Puesto' => 'required|string|max:45',
            'S_Comentarios' => 'nullable|string|max:255',
            'N_TelefonoFijo' => 'nullable|string|max:12',
            'N_TelefonoMovil' => 'nullable|string|max:12',
            'S_Email' => 'required|string|max:45',
            'tw_corporativos_id' => 'required|numeric',
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwContactosCorporativos::find($request->id)){
            try{
                $res->S_Nombre = $request->S_Nombre;
                $res->S_Puesto = $request->S_Puesto;
                $res->S_Comentarios = $request->S_Comentarios;
                $res->N_TelefonoFijo = $request->N_TelefonoFijo;
                $res->N_TelefonoMovil = $request->N_TelefonoMovil;
                $res->S_Email = $request->S_Email;
                $res->tw_corporativos_id = $request->tw_corporativos_id;
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

        if($res = TwContactosCorporativos::find($request->id)){
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
