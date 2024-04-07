@extends('layouts.main')

@section('titulo')
    Autoavaluació
@endsection

@section('menuMestres')
    <li><a class="dropdown-item" href="#">Tipus usuaris</a></li>
    <li><a class="dropdown-item" href="{{ url('usuaris') }}">Usuaris</a></li>
    <li><a class="dropdown-item" href="#">Cicles</a></li>
    <li><a class="dropdown-item" href="#">Mòduls</a></li>
    <li><a class="dropdown-item" href="#">Assignar Professors</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Assignar alumnes</a></li>
    <li><a class="dropdown-item" href="#">Resultats aprenentatge</a></li>
    <li><a class="dropdown-item" href="#">Criteris avaluacio</a></li>
@endsection

@section('menuProfes')
    <li><a class="dropdown-item" href="#">Assignar alumnes</a></li>
    <li><a class="dropdown-item" href="#">Resultats aprenentatge</a></li>
    <li><a class="dropdown-item" href="#">Criteris avaluacio</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="">Autoavaluació alumnes</a></li>
@endsection

@section('menuAlumnes')
    @if (Auth::check())
        @php $userId = Auth::user()->id  @endphp
    @endif
    <li><a class="dropdown-item" href="autoavaluacio">Autoavaluació</a></li>
@endsection

@section('nom')
    Fran
@endsection
