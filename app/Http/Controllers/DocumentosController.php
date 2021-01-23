<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwDocumentos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DocumentosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'S_Nombre' => 'required|string|max:45',
            'N_Obligatorio' => 'required|numeric',
            'S_Descripcion' => 'nullable|string|max:255',
        ]);

        try{
            $entidad = new TwDocumentos();
            $entidad->S_Nombre = $request->S_Nombre;
            $entidad->N_Obligatorio = $request->N_Obligatorio;
            $entidad->S_Descripcion = $request->S_Descripcion;
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

        if($res = TwDocumentos::find($request->id)){
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
        $res = TwDocumentos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'S_Nombre' => 'required|string|max:45',
            'N_Obligatorio' => 'required|numeric',
            'S_Descripcion' => 'nullable|string|max:255',
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwDocumentos::find($request->id)){
            try{
                $res->S_Nombre = $request->S_Nombre;
                $res->N_Obligatorio = $request->N_Obligatorio;
                $res->S_Descripcion = $request->S_Descripcion;
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

        if($res = TwDocumentos::find($request->id)){
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

    public function read3(Request $request)
    {
        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwDocumentos::find($request->id)){

            $res->tw_documentos_corporativos_asociados;

            foreach ($res->tw_documentos_corporativos_asociados as $doc_corp) {
                $doc_corp->tw_corporativo;
            }

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
}
