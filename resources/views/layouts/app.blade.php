<!DOCTYPE html>
<html class="aui ltr" dir="ltr" lang="es-ES">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GIE') }}</title>

    <link href="https://www.ehu.eus/ehu-theme/images/apple-touch-icon-precomposed.png"
          rel="apple-touch-icon-precomposed">

    {!! Html::style( asset('css/app.css')) !!}
    {!! Html::style( asset('css/aui.css')) !!}
    {!! Html::style( asset('css/main.body.css')) !!}

    {!! Html::style( asset('css/comunes.css')) !!}
    {!! Html::style( asset('css/jquery-ui.css')) !!}
    {!! Html::style( asset('css/font-awesome.min.css')) !!}
    {!! Html::style( asset('css/responsive-tabs.css')) !!}
    {!! Html::style( asset('css/responsive-tabs-style.css')) !!}
    {!! Html::style( asset('css/jquery.dataTables.min.css')) !!}
    {!! Html::style( asset('css/responsive.dataTables.min.css')) !!}
    {!! Html::style( asset('css/bootstrap-datepicker3.css')) !!}
    {!! Html::style( asset('css/bootstrap-datepicker.standalone.min.css')) !!}


    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/jquery-ui.js') !!}
    {!! Html::script('js/jquery.dataTables.min.js') !!}
    {!! Html::script('js/dataTables.responsive.min.js') !!}
    {!! Html::script('js/bootstrap-filestyle.min.js') !!}
    {!! Html::script('js/jquery.responsiveTabs.min.js') !!}
    {!! Html::script('js/bootstrap-datepicker.js') !!}
    {!! Html::script('js/bootstrap-datepicker.es.min.js') !!}
    {!! Html::script('js/bootstrap-datepicker.eu.min.js') !!}
    {!! Html::script('js/filesImgScript.js') !!}
    {!! Html::script('js/funcionesComunes.js') !!}
    {!! Html::script('js/autocomplementar.js') !!}
    {!! Html::script('js/jqueryComunes.js') !!}

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>

</head>


  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container-fluid">
        @section('header')
            @include('layouts.header')
        @show
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
           @section('sidebar')
                @include('layouts.menu')
            @show
        </div>
          <div class="col-sm-9">
          <h1>{{ config('app.name', 'GIE') }}</h1>
          @yield('content')
          </div>
      </div>
    </div>


    @yield('scripts')
    <script>
      $('.datepicker').datepicker({
          language: "{{\Session::get('locale')}}"
      });
    /*  $(function() {
          // Set idle time
          $( document ).idleTimer( 72000 );
      });

      $(function() {
          $( document ).on( "idle.idleTimer", function(event, elem, obj){
              window.location.href = "example.com/login"
          });
      });*/
    </script>
  </body>


