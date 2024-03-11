<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResultatAprenentatge;
use App\Http\Resources\ResultatAprenentatgeResource;

class ResultatAprenentatgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultat = ResultatAprenentatge::all();

        return ResultatAprenentatgeResource::collection($resultat);
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

        return new ResultatAprenentatgeResource($resultat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResultatAprenentatge $resultatAprenentatge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultatAprenentatge $resultatAprenentatge)
    {
        //
    }
}
