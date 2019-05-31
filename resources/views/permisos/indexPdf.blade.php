<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    
    <!--<link href="{{url(App\Lib\Functions::parseLang().'/css/app.css')}}" rel="stylesheet">
    <link href="{{url(App\Lib\Functions::parseLang().'/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--<link href="{{url('/css/font-awesome.min.css')}}" rel="stylesheet">-->
       <link type="text/css" media="all" rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link type="text/css" media="all" rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
  
 
</head>
<body>
     <div id="app">
       @include('layouts.menu')
        
         @permission('permission-list')
   
  
        <div class="container">

            <div class="row">
                <div class="col-md-12">                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Dysplay Name') }}</th>
                                        <th>{{ __('Descripción') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="datos">
                                   
                                    @foreach($permisos as $permiso)
                                    <tr id='linea{{ $permiso->id }}'>
                                       
                                        <td scope="row"> <input type="checkbox" name="id_permiso[{{ $loop->index +1 }}]" id="id_permiso[{{ $loop->index +1 }}]" value="{{ $permiso->id }}" /> {{ $permiso->name }}</td>
                                        <td>{{ $permiso->display_name }}</td>
                                        <td>{{ $permiso->description }}</td>
                                       <td><a href="/permisos/{{ $permiso->id }}/edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    </tr>
                                    @endforeach
                                    <tr><td>{{ __('Total:' )}} {{ $permisos->total() }}</td><td colspan='2' class='text-center'>{{ $permisos->links() }}</td><td>{{ __('Pagina actual:' )}} {{ $permisos->currentPage() }}</td></tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpermission
    </div>
    <!-- Scripts -->
     <script src="{{url('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js')}}"></script>
     <script src="{{url(App\Lib\Functions::parseLang().'/js/app.js')}}"></script>
</body>
</html>