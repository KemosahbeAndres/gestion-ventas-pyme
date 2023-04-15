@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <div id="app" class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('dashboard')}}">Gestor Ventas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-md-2 mt-lg-0" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" :class="{active:enVentas}" @click="aVentas()">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{active:enVivo}" @click="aVivo()">En vivo</a>
                        </li>
                    </ul>
                </div>
                <a class="btn btn-light" href="{{route('logout')}}">Cerrar Sesion</a>
            </div>
        </nav>
        @verbatim
        <div class="container-fluid my-4">
            <div id="ventas" v-show="enVentas">
                <h2 class="text-center">Ventas</h2>
                <div class="card">
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda delectus dicta dignissimos eaque ipsam ipsum, mollitia natus nobis, odit perspiciatis provident qui quibusdam sunt vero. Aliquam facilis iste voluptatum?</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem eligendi error exercitationem incidunt laboriosam laudantium molestiae nesciunt nihil quaerat vero. Aperiam earum, excepturi nostrum nulla quasi repudiandae sed temporibus veritatis?</p>
                    </div>
                </div>
            </div>
            <div id="live" v-show="enVivo">
                <h1>En Vivo</h1>
            </div>
        </div>
        @endverbatim
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                enVentas: true,
                enVivo: false
            },
            methods: {
                aVentas: function () {
                    this.enVentas = true
                    this.enVivo = false
                },
                aVivo: function () {
                    this.enVentas = false
                    this.enVivo = true
                }
            }
        })
    </script>

@endsection
