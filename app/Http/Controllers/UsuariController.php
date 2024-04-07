<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;


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
        $usuari = new Usuari();

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
        $usuari->contrasenya = $request->pass == null ? $usuari->contrasenya : bcrypt($request->pass);
        $usuari->correu = $request->correu == null ? $usuari->correu : $request->correu;
        $usuari->nom = $request->nom == null ? $usuari->nom : $request->nom;
        $usuari->cognom = $request->cognom == null ? $usuari->cognom : $request->cognom;


        if(!isset($request->isPasswordChange)){

            if(isset($request->actiu)){
                $usuari->actiu = true;
            }else{
                $usuari->actiu = false;
            }
        }

        $usuari->tipus_usuaris_id = 2;

        $usuari->save();

        return redirect()->action([UsuariController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Usuari $usuari)
    {

        try {

            $usuari->delete();
            $request->session()->flash('success','Registro borrado correctamente');

        } catch (QueryException $ex) {

            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error',$mensaje);

        }

        return redirect()->action([UsuariController::class,'index']);
    }

    public function changePassword(Usuari $usuari)
    {

        return view('usuaris.usuari_change_pass', compact('usuari'));

    }

    public function login(Request $request){

        $username = $request->user;
        $password = $request->pass;

        $user = Usuari::where('nom_usuari',$username)->first();

        if($user != null && Hash::check($password,$user->contrasenya)){
            Auth::login($user);
            // Auth::attempt(['nom_usuari' => $username, 'contrasenya' => $password]);
            $response = redirect('/home');

        }else{

            $request->session()->flash('error','Usuari o password incorrecte');
            $response = redirect('/login')->withInput();
        }

        return $response;

    }

    public function showLogin(){

        return view('auth.login');
    }

    public function logout(){

        Auth::logout();
        return redirect('/login');
    }

    public function autoavaluacio(){

        return view('usuaris.autoavaluacio');
    }

    public function autoavaluacioProfessor(){

        return view('profesor.autoavaluacio');
    }
}
