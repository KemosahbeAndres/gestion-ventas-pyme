@extends('layouts.app')
@section('content')
    <div id="app" class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('dashboard')}}">Gestor Ventas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" :class="{active:enVentas}" @click="aVentas()">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" :class="{active:enVivo}" @click="aVivo()">En vivo</a>
                        </li>
                    </ul>
                </div>

                <a @click="logout()" class="btn btn-light">Cerrar Sesion</a>
            </div>
        </nav>
        @verbatim
        <div class="container-fluid my-4">
            <div id="ventas" v-show="enVentas">
                <h1>En Ventas</h1>
            </div>
            <div id="live" v-show="enVivo">
                <h1>En Vivo</h1>
            </div>
        </div>
        @endverbatim
    </div>

    <script>

        let app = new Vue({
            el: '#app',
            created: function () {
                if(!this.validToken()) {
                    this.toLogin()
                }
            },
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
                },
                logout: function() {
                    if(!this.validToken()) {
                        return false;
                    }
                    const csrf = document.getElementsByTagName('meta')['csrf-token'].content
                    //axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf
                    axios.head('/api/sanctum/csrf-cookie').then(
                        function (cookie) {
                            //axios.defaults.headers.common['Authentication'] = 'Bearer '+ token;
                            axios.get(
                                '/api/logout',
                            ).then(function (response) {
                                if(response.data.done) {
                                    localStorage.clear()
                                    app.toLogin()
                                }
                                //localStorage.clear()
                                //app.toLogin()
                            }).catch(error => console.error(error))
                        }
                    )

                },
                toLogin: function () {
                    window.location.href = window.location.origin + "/login"
                },
                validToken: function (){
                    let token = localStorage.getItem('access_token')
                    if (token == null) {
                        return false;
                    }
                    axios.defaults.headers.common['Authentication'] = 'Bearer '+ token;
                    axios.defaults.headers.common['Authorization'] = 'Bearer '+ token;
                    return true;
                }
            }
        })
    </script>

@endsection
