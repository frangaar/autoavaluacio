@extends('index')

@section('contingut')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuari</h5>
            <form action="{{ action([App\Http\Controllers\UsuariController::class,'store']) }}" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="nomusu" class="col-sm-1 col-form-label">Nom usuari</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="nomusu" name="nomusu">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="correu" class="col-sm-1 col-form-label">Contrasenya</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="pass" name="pass">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="correu" class="col-sm-1 col-form-label">Correu</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="correu" name="correu">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nom" class="col-sm-1 col-form-label">Nom</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="nom" name="nom">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cognom" class="col-sm-1 col-form-label">Cognom</label>
                    <div class="col-sm-11">
                        <input type="textarea" class="form-control" id="cognom" name="cognom">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="actiu" class="col-sm-1 col-form-label">Actiu</label>
                    <div class="col-sm-11">
                        <input class="form-check-input" type="checkbox" name="actiu" id="actiu" value="actiu">
                    </div>
                </div>
                <div class="mb-3 row align-items-end">
                    <div class="col d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Accept</button>
                        <a href="" class="btn btn-primary mr-1">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
