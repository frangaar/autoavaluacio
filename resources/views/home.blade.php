@extends('index')


@section('contingut')

    @if (Auth::check() && (Auth::user()->rol->nombre == 'admin' || Auth::user()->rol->nombre == 'rider' || Auth::user()->rol->nombre == 'centro'))

        <h1>{{ Auth::user()->rol->nombre }}</h1>
    @endif
    
@endsection

