@extends('layouts.app')
@section('content')
    <div class="main-content py-4">
        <a href="{{route('logout')}}" class="btn btn-primary">Cerrar Sesion</a>
        <div class="container-fluid">
            <h1>Contenido principal</h1>
        </div>
    </div>
@endsection
