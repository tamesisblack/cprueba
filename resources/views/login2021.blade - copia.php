
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="dJD9YgvmicBzfetgxa5tXIhHbxdopFT1u2cgaQab">

    <title>SISCAD | SISTEMA GESTION PARA TALLERES</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/css/template_login/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/template_login/animate.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/template_login/fontawesome-all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/template_login/theme.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/template_login/auth.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.min.css" />--}}

</head>

<body>

<div class="app" id="app">
    <section class="auth auth__form-right">
        <article class="auth__image" style="background-image: url('{{ asset('/imagenes/login/logo_right.jpg') }}') ">
            {{--<img class="auth__logo top-left" src="{{asset('imagenes/template_login/700x300.jpg')}}" alt="Logo" />--}}
        </article>
        <article class="auth__form">
            <form method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="text-center">
                    <img src="{{ asset('/imagenes/login/logo_top.png') }}" alt="">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Usuario</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" v-model="email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="d-flex justify-content-between">
                        <label for="password">Clave</label>
                        <a href="#" tabindex="5">¿Has olvidado tu contraseña?</a>
                    </div>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control hide-password ">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <button type="button" class="btn btn-eye" id="btnEye" tabindex="4">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="sucursal">Sucursal</label>
                    <select class="form-control" name="site">
                        <option value="">Seleccione una sucursal</option>
                        <option v-for="site in userSites" :value="site.id" >@{{site.name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember"> Recordar
                    </label>
                </div>
                <a class="btn btn-danger btn-sm text-white mb-2" href="front/nuevo-cliente">
                    NUEVO CLIENTE
                </a>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-sign-in"></i> Acceder
                </button>
            </form>
        </article>
    </section>

</div>

<script>
  var inputPassword = document.getElementById('password');
  var btnEye = document.getElementById('btnEye');
  btnEye.addEventListener('click', function () {
    if (inputPassword.classList.contains('hide-password')) {
      inputPassword.type = 'text';
      inputPassword.classList.remove('hide-password');
      btnEye.innerHTML = '<i class="fa fa-eye-slash"></i>'
    } else {
      inputPassword.type = 'password';
      inputPassword.classList.add('hide-password');
      btnEye.innerHTML = '<i class="fa fa-eye"></i>'
    }
  });
</script>

<script src="{{asset('js/vue.js')}}"></script>

<script src="{{asset('js/axios.js')}}"></script>

<script  src="{{asset('js/sites.js')}}"></script>


</body>

</html>