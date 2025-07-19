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


    <!-- Styles -->

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/template_login/fontawesome-all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('/css/template_login/auth.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/font-awesome.css')}}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.29/sweetalert2.min.css" />--}}
    <style>
        body {
            font-size: 14px !important;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0px 0px 10px 0px;
            padding: 0px;
            background: #FFF;
            color: #666666;
        }
        .auth a {
            color: #f8f8fb;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="app" id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema Control y Administracion 2.0
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Inicio</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else

                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>Cerrar Sesión</a>
                            </div>
                        </div>
                       {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesión</a></li>
                            </ul>
                        </li>--}}
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <section class="auth auth__form-right">
        <article class="auth__image" style="background-image: url('{{ asset('/imagenes/login/logo_right.jpg') }}') ">

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
                        <a href="#" class="pull-right" tabindex="5">¿Has olvidado tu contraseña?</a>
                    </div>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control hide-password ">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <button type="button" class="btn btn-eye" id="btnEye" style="top: 2.4vh;" tabindex="4">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
               
               
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fa fa-btn fa-sign-in"></i> Acceder
                </button>
            </form>
        </article>
    </section>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" ></script>

<script src="{{asset('js/vue.js')}}"></script>

<script src="{{asset('js/axios.js')}}"></script>

<script  src="{{asset('js/sites.js')}}"></script>

<script type="text/javascript">
  var inputPassword = document.getElementById('password');
  var btnEye = document.getElementById('btnEye');
  btnEye.addEventListener('click', function (e) {
    e.preventDefault()
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
</body>

</html>