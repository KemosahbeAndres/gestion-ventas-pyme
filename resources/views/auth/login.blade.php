@extends('layouts.app')
@section('content')
    <div id="app" class="login-form py-4">
        <div class="container">
            @if(Session::has('error'))
                <div class="alert alert-warning text-center">
                    !! {{Session::get('error')}} !!
                </div>
            @endif
            <h1 class="text-center my-4">Inicia Sesion</h1>
            <form name=login class="d-grid gap-3" method="post">
                @csrf
                <input type="text" class="form-control" placeholder="Correo" name="email" required autofocus>
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Recordar
                    </label>
                </div>
                <input @click.submit.prevent="login()" type="submit" class="btn btn-primary btn-block" value="Iniciar Sesion">
                <!--<a href="#">¿No tienes cuenta? Registrate</a>-->
            </form>
        </div>
    </div>
    <script>
        let app = new Vue({
            el: '#app',
            computed: {
                token: {
                    get: function () {
                        let token = ""
                        let stored = localStorage.getItem('access_token')
                        if(stored != null) {
                            token = stored
                        }
                        return token
                    },
                    set: function (value) {
                        localStorage.setItem('access_token', value)
                    }
                }
            },
            methods: {
                saveToken: function (value) {
                    localStorage.setItem('access_token', value)
                },
                login: function () {

                    /*axios.head(
                        '/sanctum/csrf-cookie'
                    ).then(function (resp) {*/
                        //console.log(resp)
                        //console.log(resp.status == 204 ? "[CSRF COOKIE OK]" : "[CSRF COOKIE ERROR]")
                        //const xsrf = resp.config.headers['X-XSRF-TOKEN']
                        const csrf = document.getElementsByTagName('meta')['csrf-token'].content
                        //const csrf = resp
                        //console.log(csrf)
                        axios.defaults.headers.common = {
                            //'X-Requested-With': 'XMLHttpRequest',
                            //'X-Requested-With': 'application/x-www-form-urlencoded',
                            //'Content-Type': 'application/x-www-form-urlencoded',
                            //"Content-Type": "multipart/form-data",
                            'X-CSRF-TOKEN' : csrf,
                            //'X-XSRF-TOKEN': xsrf
                        }

                        let form = new FormData();

                        form.append('email', document.forms.login.children.email.value,)
                        form.append('password', document.forms.login.children.password.value)
                        //let email = form.get('email')
                        //let pass = form.get('password')

                        //console.info("credenciales: "+ email + ":" + pass)
                        axios.head('/api/sanctum/csrf-cookie').then(function (resp) {
                        axios({
                            method: 'post',
                            url: '/api/login',
                            data: form
                        }).then(function (response) {
                            console.log("[RESPONSE OK]")
                            console.log(response.data)
                            console.log("saved: " + app.token)
                            app.token = response.data['access_token']
                            window.location.href = window.location.origin + "/dashboard"
                            //app.saveToken(response.data['access_token'])
                        }).catch(error => console.log(error));
                    });
                }
            }
        })
    </script>
@endsection
