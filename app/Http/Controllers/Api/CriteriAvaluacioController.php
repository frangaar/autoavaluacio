<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuari;
use Illuminate\Http\Request;
use App\Models\CriteriAvaluacio;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Resources\CriteriAvaluacioResource;

class CriteriAvaluacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteris = CriteriAvaluacio::all();

        return CriteriAvaluacioResource::collection($criteris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $criteri = new CriteriAvaluacio();

        $criteri->ordre = $request->ordre;
        $criteri->descripcio = $request->descripcio;
        $criteri->actiu = $request->actiu;
        $criteri->resultats_aprenentatge_id = $request->resultats_aprenentatge_id;

        try{
            $criteri->save();
            $response = (new CriteriAvaluacioResource($criteri))
                ->response()
                ->setStatusCode(201);
        }
        catch(QueryException $ex){

            $response = \response()
                ->json(['error' => "Error al guardar"], 400);
        }

        return $response;

    }

    /**
     * Display the specified resource.
     */
    public function show(CriteriAvaluacio $criteri)
    {
        $criteri = CriteriAvaluacio::find($criteri->id);
        return new CriteriAvaluacioResource($criteri);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CriteriAvaluacio $criteri)
    {
        $criteri->ordre = $request->ordre;
        $criteri->descripcio = $request->descripcio;
        $criteri->actiu = $request->actiu;
        $criteri->resultats_aprenentatge_id = $request->resultats_aprenentatge_id;

        try{
            $criteri->save();
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
    public function destroy(CriteriAvaluacio $criteri)
    {

        try{
            $criteri->delete();
            $response = \response()
                        ->json(['missatge' => "Registro borrado correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al borrar"], 400);
        }

        return $response;
    }

    public function saveCriteris(Request $request, $userId)
    {
        try{
            $usuari = Usuari::find($userId);

            foreach ($request->notas as $key => $value) {
                $notasList[$key+1] = ['nota' => $value];
            }

            $usuari->criteris()->sync($notasList,false);

            $response = \response()
                        ->json(['missatge' => "Registros añadido correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al actualizar"], 400);
        }

        return $response;
    }
}
