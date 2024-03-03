@extends('index')

@section('contingut')

<div class="card">
    <div class="card-body">
        <form action= {{ action([App\Http\Controllers\UsuariController::class,'index']) }}>
            <div class="form-row">
                <div class="row align-items-start">
                    <div class="col">
                        @if (old('actiuBuscar') == 'actiu')
                            <div class="custom-control custom-checkbox">
                                <input class="form-check-input" type="checkbox" id="actiuBuscar" name="actiuBuscar" value="actiu" checked>
                                <label class="form-check-label" for="actiuBuscar">Actiu</label>
                            </div>
                        @else
                            <div class="custom-control custom-checkbox">
                                <input class="form-check-input" type="checkbox" id="actiuBuscar" name="actiuBuscar" value="actiu">
                                <label class="form-check-label" for="actiuBuscar">Actiu</label>
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Nom Usuari</th>
        <th scope="col">Correu</th>
        <th scope="col">Nom</th>
        <th scope="col">Cognom</th>
        <th scope="col">Actiu</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($usuaris as $usuari)
            <tr>
                <form>

                </form>
                <td>{{ $usuari->id }}</td>
                <td>{{ $usuari->nom_usuari }}</td>
                <td>{{ $usuari->correu }}</td>
                <td>{{ $usuari->nom }}</td>
                <td>{{ $usuari->cognom }}</td>
                <td>
                    @if ($usuari->actiu)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actiu" value="actiu" checked>
                            <label class="form-check-label" for="flexCheckDefault"></label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actiu">
                        </div>
                    @endif
                </td>
                <td>
                    <form class="float-right edit" action=" {{ action([App\Http\Controllers\UsuariController::class,'changePassword'],['usuari' => $usuari->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Change password</button>
                    </form>
                    <form class="float-right edit" action=" {{ action([App\Http\Controllers\UsuariController::class,'edit'],['usuari' => $usuari->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Edit</button>
                    </form>
                    <form class="float-right" action=" {{ action([App\Http\Controllers\UsuariController::class,'destroy'],['usuari' => $usuari->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $usuaris->links() }}

  <a href="{{ url('usuaris/create') }}" class="btn btn-secondary">Nou usuari</a>

@endsection
