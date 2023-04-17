@extends('layouts.app')
@section('content')
    <div id="app" class="register-form py-4">
        <div class="container">
            <h1 class="text-center my-4">Registrate</h1>

            <form name="registerForm" class="d-grid gap-3" method="post">
                @csrf
                <input type="text" class="form-control" placeholder="Nombre" name="name" required autofocus>
                <input type="text" class="form-control" placeholder="Correo" name="email" required>
                <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
                <input @click.prevent.submit="register()" type="submit" class="btn btn-primary btn-block" value="Registrarme">
                <a href="{{route('login')}}">¿Tienes cuenta? Inicia sesion</a>
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
                register: function () {
                    let name = document.forms.registerForm.children.name.value
                    let email = document.forms.registerForm.children.email.value
                    let password = document.forms.registerForm.children.password.value

                    let form = new FormData();

                    form.append('name', name)
                    form.append('email', email)
                    form.append('password', password)

                    axios.post(
                        '/api/register',
                        form
                    ).then(function (response) {
                        console.log(response)
                        app.token = response.data['access_token']
                        window.location.href = window.location.origin + "/dashboard"
                    }).catch(error => console.log(error))
                }
            }
        })
    </script>
@endsection

