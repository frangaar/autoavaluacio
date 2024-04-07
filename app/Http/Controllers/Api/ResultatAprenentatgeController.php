<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResultatAprenentatge;
use Illuminate\Database\QueryException;
use App\Http\Resources\ResultatAprenentatgeResource;

class ResultatAprenentatgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultats = ResultatAprenentatge::all();

        return ResultatAprenentatgeResource::collection($resultats);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultat = new ResultatAprenentatge();

        $resultat->ordre = $request->ordre;
        $resultat->descripcio = $request->descripcio;
        $resultat->actiu = $request->actiu;
        $resultat->moduls_id = $request->moduls_id;

        try {
            $resultat->save();
            $response = (new ResultatAprenentatgeResource($resultat))
                        ->response()
                        ->setStatusCode(201);
        } catch (QueryException $ex) {

            $mensaje = "Error en la respuesta";
            $response = \response()
                        ->json(["error" => $mensaje],400);
        }


        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(ResultatAprenentatge $resultat)
    {
        $resultat = ResultatAprenentatge::find($resultat->id);

        return new ResultatAprenentatgeResource($resultat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultatAprenentatge $resultat)
    {

        $resultat->ordre = $request->ordre;
        $resultat->descripcio = $request->descripcio;
        $resultat->actiu = $request->actiu;
        $resultat->moduls_id = $request->moduls_id;

        try{
            $resultat->save();
            $response = \response()
                        ->json(['missatge' => "Registro actualizado correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al borrar"], 400);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultatAprenentatge $resultat)
    {
        try{
            $resultat->delete();
            $response = \response()
                        ->json(['missatge' => "Registro borrado correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al borrar"], 400);
        }

        return $response;
    }

    public function mostrarResultadosAprendizaje()
    {

        $rubricas = ResultatAprenentatge::with('criteris.rubriques.criteri')->groupBy('id')->get();

        return ResultatAprenentatgeResource::collection($rubricas);
    }

}
