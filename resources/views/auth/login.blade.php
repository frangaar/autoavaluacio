@extends('index')

@section('contingut')

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <form action="{{ action([App\Http\Controllers\UsuariController::class,'login']) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="user" name="user">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>
    </div>
</div>

@endsection
