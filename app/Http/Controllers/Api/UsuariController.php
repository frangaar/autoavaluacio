<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsuariResource;

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $usuari = Usuari::find($request->usuari_id);
            $modulsList = $request->moduls_id;
            $usuari->moduls()->attach($modulsList);
            $response = \response()
                        ->json(['missatge' => "Registros añadido correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al borrar"], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Usuari $usuari)
    {

        try{
            $modulsList = $request->moduls_id;
            $usuari->moduls()->detach($modulsList);
            $response = \response()
                        ->json(['missatge' => "Registros borrado correctamente"], 200);
        }
        catch(QueryException $ex){

            $response = \response()
                        ->json(['error' => "Error al borrar"], 400);
        }

        return $response;
    }

    public function modulByUser($userId){

        $moduls = Usuari::with('moduls')->find($userId);

        return UsuariResource::collection($moduls->moduls);
    }

    public function mostrarResultadosAprendizajePorUser($userId)
    {

        $rubricas = Usuari::with('criteris')->find($userId);

        return UsuariResource::collection($rubricas->criteris);
    }
}
