<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet prefetch' href='css/materialize.min.css'>
    <link rel='stylesheet prefetch' href='css/login.css'>

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    <div id="login-page" class="row">
        <div class="col s12 z-depth-6 card-panel">
            <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <h2 class="header">Ingreso al sistema</h2>
                </div>
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
                        <i class="material-icons prefix">mail_outline</i>
                        <input class="validate" id="email" type="email"name="email" value="{{ old('email') }}" required autofocus>
                        <label for="email" data-error="error" data-success="correco">correo</label>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('password') ? ' has-error' : '' }}">
                        <i class="material-icons prefix">lock_outline</i>
                        <input id="password" type="password" name="password">
                        <label for="password">contrasaeña</label>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12  login-text">
                        <input type="checkbox" id="remember-me" name="remenber"/>
                        <label for="remember-me">Recordar</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn waves-effect waves-light col s12 black">Ingresar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 m6 l6">
                        <p class="margin medium-small">ingreso con <a href="#facebook">facebook</a></p>
                    </div>
                    <div class="input-field col s6 m6 l6">
                        <p class="margin right-align medium-small"><a href="{{ url('/password/reset') }}">Recuperar contraseña</a></p>
                    </div>
                </div>
                <a href="{{ url('/register') }}">Registrar</a>

            </form>
        </div>
    </div>

<script src='js/jquery.min.js'></script>
<script src='js/materialize.min.js'></script>
</body>
</html>






