<html>
<head>
    <link type="text/css" media="all" rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script type="text/javascript">var centreGot = false;</script>
    {!!$map['js']!!}
</head>
<body>
    <div class="row" style="margin: 5px; padding:5px;">
        <div class="col-md-12 margin-tb ">
            <div class="panel panel-default " style=" padding:5px">
        <p> {{ __('Nº clientes :') }}{{ $mensaje['total'] }}<br>{{ __('Con puntero:') }}<b> {{ $mensaje['conPuntero'] }} </b><br> {{ __('Sin puntero :') }} <b>{{ $mensaje['sinPuntero'] }} </b></p>
    </div>
    {!!$map['html']!!}
</body>
</html>