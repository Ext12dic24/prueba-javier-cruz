<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwDocumentosCorporativos;
use Carbon\Carbon;
use CreateTwDocumentosTable;
use Illuminate\Support\Facades\Validator;

class DocumentosCorporativosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'tw_corporativos_id' => 'required|numeric',
            'tw_documentos_id' => 'required|numeric',
            'S_ArchivoUrl' => 'nullable|string|max:255'
        ]);

        try{
            $entidad = new TwDocumentosCorporativos();
            $entidad->tw_corporativos_id = $request->tw_corporativos_id;
            $entidad->tw_documentos_id = $request->tw_documentos_id;
            $entidad->S_ArchivoUrl = $request->S_ArchivoUrl;
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

        if($res = TwDocumentosCorporativos::find($request->id)){
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
        $res = TwDocumentosCorporativos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'tw_corporativos_id' => 'required|numeric',
            'tw_documentos_id' => 'required|numeric',
            'S_ArchivoUrl' => 'nullable|string|max:255'
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwDocumentosCorporativos::find($request->id)){
            try{
                $res->tw_corporativos_id = $request->tw_corporativos_id;
                $res->tw_documentos_id = $request->tw_documentos_id;
                $res->S_ArchivoUrl = $request->S_ArchivoUrl;
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

        if($res = TwDocumentosCorporativos::find($request->id)){
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
