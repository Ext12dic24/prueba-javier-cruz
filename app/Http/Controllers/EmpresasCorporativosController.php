<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwEmpresasCorporativos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmpresasCorporativosController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'S_RazonSocial' => 'required|string|max:150',
            'S_RFC' => 'required|string|max:13',
            'S_Pais' => 'nullable|string|max:75',
            'S_Estado' => 'nullable|string|max:75',
            'S_Municipio' => 'nullable|string|max:75',
            'S_ColoniaLocalidad' => 'nullable|string|max:75',
            'S_Domicilio' => 'nullable|string|max:100',
            'S_CodigoPostal' => 'nullable|numeric|max:5',
            'S_UsoCFDI' => 'nullable|string|max:45',
            'S_UrlRFC' => 'nullable|string|max:255',
            'S_UrlActaConstitutiva' => 'nullable|string|max:255',
            'S_Activo' => 'required|numeric',
            'S_Comentarios' => 'nullable|string|max:255',
            'tw_corporativos_id' => 'required|numeric',
        ]);

        try{
            $entidad = new TwEmpresasCorporativos();
            $entidad->S_RazonSocial = $request->S_RazonSocial;
            $entidad->S_RFC = $request->S_RFC;
            $entidad->S_Pais = $request->S_Pais;
            $entidad->S_Estado = $request->S_Estado;
            $entidad->S_Municipio = $request->S_Municipio;
            $entidad->S_ColoniaLocalidad = $request->S_ColoniaLocalidad;
            $entidad->S_Domicilio = $request->S_Domicilio;
            $entidad->S_CodigoPostal = $request->S_CodigoPostal;
            $entidad->S_UsoCFDI = $request->S_UsoCFDI;
            $entidad->S_UrlRFC = $request->S_UrlRFC;
            $entidad->S_UrlActaConstitutiva = $request->S_UrlActaConstitutiva;
            $entidad->S_Activo = $request->S_Activo;
            $entidad->S_Comentarios = $request->S_Comentarios;
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

        if($res = TwEmpresasCorporativos::find($request->id)){
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
        $res = TwEmpresasCorporativos::all();

        return response()->json([
            'respuesta' => 'Se ha recuperado la información',
            'datos' => $res
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'S_RazonSocial' => 'required|string|max:150',
            'S_RFC' => 'required|string|max:13',
            'S_Pais' => 'nullable|string|max:75',
            'S_Estado' => 'nullable|string|max:75',
            'S_Municipio' => 'nullable|string|max:75',
            'S_ColoniaLocalidad' => 'nullable|string|max:75',
            'S_Domicilio' => 'nullable|string|max:100',
            'S_CodigoPostal' => 'nullable|numeric|max:5',
            'S_UsoCFDI' => 'nullable|string|max:45',
            'S_UrlRFC' => 'nullable|string|max:255',
            'S_UrlActaConstitutiva' => 'nullable|string|max:255',
            'S_Activo' => 'required|numeric',
            'S_Comentarios' => 'nullable|string|max:255',
            'tw_corporativos_id' => 'required|numeric',
        ]);

        Validator::make([
            'id' => $request->id
        ], [
            'id' => 'required|numeric',
        ])->validate();

        if($res = TwEmpresasCorporativos::find($request->id)){
            try{
                $res->S_RazonSocial = $request->S_RazonSocial;
                $res->S_RFC = $request->S_RFC;
                $res->S_Pais = $request->S_Pais;
                $res->S_Estado = $request->S_Estado;
                $res->S_Municipio = $request->S_Municipio;
                $res->S_ColoniaLocalidad = $request->S_ColoniaLocalidad;
                $res->S_Domicilio = $request->S_Domicilio;
                $res->S_CodigoPostal = $request->S_CodigoPostal;
                $res->S_UsoCFDI = $request->S_UsoCFDI;
                $res->S_UrlRFC = $request->S_UrlRFC;
                $res->S_UrlActaConstitutiva = $request->S_UrlActaConstitutiva;
                $res->S_Activo = $request->S_Activo;
                $res->S_Comentarios = $request->S_Comentarios;
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

        if($res = TwEmpresasCorporativos::find($request->id)){
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
