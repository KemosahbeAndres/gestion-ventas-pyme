@extends('layouts.app')
@section('content')
    <main class="login-form py-4">
        <div class="container">
            <h1 class="text-center my-4">Inicia Sesion</h1>
            <form class="d-grid gap-3" method="post" action="{{route('login.custom')}}">
                @csrf
                @if($errors->has('login'))
                    <span>{{ $errors->first('login') }}</span>
                @endif
                <input type="text" class="form-control" placeholder="Correo" name="email" required autofocus>
                @if($errors->has('login'))
                    <span>{{ $errors->first('login') }}</span>
                @endif
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Recordar
                    </label>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Iniciar Sesion">
                <a href="{{route('register')}}">¿No tienes cuenta? Registrate</a>
            </form>
        </div>
    </main>
@endsection
