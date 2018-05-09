<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/img/icon-evernote.png') }}" />
  <link rel="icon" type="image/png" href="{{ url('/img/icon-evernote.png') }}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>{{ 'Ganesha[SIGE]' }}</title>


    <!--Styles-->
    <link href="{{ url('/css/estilos.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('/css/font-awesome/css/font-awesome.min.css') }}">

  @yield('customcss')
</head>
<body >

    <div >



<div class="content-wrapper ">
      <Br>
      <Br>
      <Br>
      <Br>
      <Br>


<div class="container ">
    <div class="row ">
        <div class="col-md-8" style="margin-top: 15%; margin-left: 15%;">
            <div class="panel panel-default">
                <div class="panel-heading">Recuperar Password
                  <i class="fa fa-question quest" data-toggle="tooltip"  data-html="true" data-placement="bottom" title="Ingrese su correo para recuperar su contraseña"></i>
                  </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Correo con nueva contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

  </div>
   <!-- Jquery a de estar siempre de primero -->
  <script src="{{ url('/js/jquery.js') }}"></script>
  <script src="{{ url('/js/bootstrap.js') }}"></script>
  <script src="{{ url('/js/Admin.min.js') }}"></script>

    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

</body>
</html>
