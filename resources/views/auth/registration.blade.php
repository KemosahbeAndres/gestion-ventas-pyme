@extends('layouts.app')
@section('content')
    <main class="register-form py-4">
        <div class="container">
            <h1 class="text-center my-4">Registrate</h1>

            <form class="d-grid gap-3" method="post" action="{{route('register.custom')}}">
                @csrf
                <input type="text" class="form-control" placeholder="Nombre" name="name" required autofocus>
                <input type="text" class="form-control" placeholder="Correo" name="email" required>
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <input type="submit" class="btn btn-primary btn-block" value="Registrarme">
                <a href="{{route('login')}}">¿Tienes cuenta? Inicia sesion</a>
            </form>
        </div>
    </main>
@endsection

