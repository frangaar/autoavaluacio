@extends('layouts.main')

@section('contingut')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuari</h5>
            <form class="float-right" action=" {{ action([App\Http\Controllers\UsuariController::class,'update'],['usuari' => $usuari->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="nomusu" class="col-sm-1 col-form-label">Nom usuari</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="nomusu" name="nomusu" value="{{ $usuari->nom_usuari }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="correu" class="col-sm-1 col-form-label">Contrasenya</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="pass" name="pass" value="{{ $usuari->contrasenya }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="correu" class="col-sm-1 col-form-label">Correu</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="correu" name="correu" value="{{ $usuari->correu }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nom" class="col-sm-1 col-form-label">Nom</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="nom" name="nom" value="{{ $usuari->nom }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cognom" class="col-sm-1 col-form-label">Cognom</label>
                    <div class="col-sm-11">
                        <input type="textarea" class="form-control" id="cognom" name="cognom" value="{{ $usuari->cognom }}" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="actiu" class="col-sm-1 col-form-label">Actiu</label>
                    <div class="col-sm-11">
                        @if($usuari->actiu)
                            <input class="form-check-input" type="checkbox" name="actiu" id="actiu" value="actiu" checked disabled>
                        @else
                            <input class="form-check-input" type="checkbox" name="actiu" id="actiu" value="actiu" disabled>
                        @endif

                    </div>
                </div>
                <div class="mb-3 row align-items-end">
                    <div class="col d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        <a href=" {{ url('usuaris') }}" class="btn btn-primary mr-1">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
