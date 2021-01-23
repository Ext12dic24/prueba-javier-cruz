<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwContratosCorporativos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ContratosCorporativosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'D_FechaInicio' => 'required|string',
            'D_FechaFin' => 'required|string',
            'S_URLContrato' => 'nullable|string|max:255',
            'tw_corporativos_id' => 'required|numeric'
        ]);

        try{
            $entidad = new TwContratosCorporativos();
            $entidad->D_FechaInicio = Carbon::createFromFormat('d/m/Y H:i:s',  $request->D_FechaInicio);
            $entidad->D_FechaFin = Carbon::createFromFormat('d/m/Y H:i:s',  $request->D_FechaFin);
            $entidad->S_URLContrato = $request->S_URLContrato;
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

        if($res = TwContratosCorporativos::find($request->id)){
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
        $res = TwContratosCorporativos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'D_FechaInicio' => 'required|string',
            'D_FechaFin' => 'required|string',
            'S_URLContrato' => 'nullable|string|max:255',
            'tw_corporativos_id' => 'required|numeric'
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwContratosCorporativos::find($request->id)){
            try{
                $res->D_FechaInicio = Carbon::parse($request->D_FechaInicio);
                $res->D_FechaFin = Carbon::parse($request->D_FechaFin);
                $res->S_URLContrato = $request->S_URLContrato;
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

        if($res = TwContratosCorporativos::find($request->id)){
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
