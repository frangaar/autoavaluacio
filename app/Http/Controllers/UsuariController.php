<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

class UsuariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $actiu = $request->actiuBuscar;

        if ($actiu == 'actiu'){

            $usuaris = Usuari::where('actiu','=',true)->paginate(5)->withQueryString();

        }else{

            $usuaris = Usuari::paginate(5);

        }

        $request->session()->flashInput($request->input());

        return view('usuaris.index',compact('usuaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuaris.usuari');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuari = new Usuari;

        $usuari->nom_usuari = $request->nomusu;
        $usuari->contrasenya = bcrypt($request->pass);
        $usuari->correu = $request->correu;
        $usuari->nom = $request->nom;
        $usuari->cognom = $request->cognom;
        $usuari->actiu = $request->actiu == 'actiu' ? true : false;
        $usuari->tipus_usuaris_id = 2;

        $usuari->save();

        return redirect('/usuaris');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuari $usuari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuari $usuari)
    {

        return view('usuaris.usuari_edit', compact('usuari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuari $usuari)
    {

        $usuari->nom_usuari = $request->nomusu == null ? $usuari->nom_usuari : $request->nomusu;
        $usuari->contrasenya = $request->pass == null ? $usuari->contrasenya : $request->pass;
        $usuari->correu = $request->correu == null ? $usuari->correu : $request->correu;
        $usuari->nom = $request->nom == null ? $usuari->nom : $request->nom;
        $usuari->cognom = $request->cognom == null ? $usuari->cognom : $request->cognom;
        $usuari->actiu = $request->actiu == 'actiu' ? true : false;
        $usuari->tipus_usuaris_id = 2;

        $usuari->save();

        return redirect()->action([UsuariController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuari $usuari)
    {

        $hasDataRelated = Usuari::find($usuari->id);

        if((sizeof($hasDataRelated->criteris) && sizeof($hasDataRelated->moduls)) == 0){
            $usuari->delete();
        };

        return redirect()->action([UsuariController::class,'index']);
    }

    public function changePassword(Usuari $usuari)
    {

        return view('usuaris.usuari_change_pass', compact('usuari'));

    }
}
