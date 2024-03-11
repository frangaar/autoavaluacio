@extends('index')

@section('contingut')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Usuari</h5>
            <form class="float-right" action=" {{ action([App\Http\Controllers\UsuariController::class,'update'],['usuari' => $usuari->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="correu" class="col-sm-1 col-form-label">Contrasenya</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="pass" name="pass" value="{{ $usuari->contrasenya }}">
                        <input type="hidden" class="form-control" name="isPasswordChange" value="true">
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
