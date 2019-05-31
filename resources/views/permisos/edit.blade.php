@extends('layouts.app')

@section('content')
    @permission('permission-list')
        <div class="container">
            {!! Breadcrumbs::render('permisosEditar', $permiso) !!}
        	<div class="row">
        	    <div class="col-lg-12 margin-tb">
        	        <div class="pull-left">
        	            <h2>{{ __('Permission Management')}} </h2>
        	        </div>
        	      <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('permisos.ver') }}"> Back</a>
	        </div>
        	    </div>
        	</div>
        	@if ($message = Session::get('success'))
        		<div class="alert alert-success">
        			<p>{{ $message }}</p>
        		</div>
        	@endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ __('Permisos')}}
                       </div>
                        <div class="panel-body">
                    		<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                        		<strong> {{ __('Permission Deleted.') }}</strong>
                    		</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Dysplay Name') }}</th>
                                        <th>{{ __('Descripción') }}</th>
                                    </tr>
                                </thead>
                                @permission('permission-create')
                                    {!!Form::open()!!}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                    <input type="hidden" name="_token" value="{{ $permiso->id }}" id="token">
                                    <input type="hidden" name="_URL_BASE_DEFAULT" value="{{ env('URL_BASE_DEFAULT') }}" id="URL_BASE_DEFAULT">
                                        <tr>
                                            <td>{!!Form::text('name', $permiso->name , [
                                            'id'         => 'name',
                                            'class'      =>'form-control editarPermiso',
                                            'placeholder'=> 'Ingresa nombre',
                                            'nombreCampo'=> 'name',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id ,
                                            ])!!}
                                            </td>
                                            <td>
                                                {!!Form::text('display_name', $permiso->display_name , [
                                                'id' => 'display_name',
                                                'class'=>'form-control editarPermiso',
                                                'placeholder'=> ' Ingresa display name',
                                                'nombreCampo'=> 'display_name',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id , ])!!}
                                                </td>
                                            <td>{!!Form::text('description', $permiso->description, ['id' => 'description', 'class'=>'form-control editarPermiso', 'placeholder'=> ' Ingresa display name',
                                            'nombreCampo'=> 'description',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id , ])!!}</td>
                                            <td></td>
                                        </tr>
                                    {!!Form::close()!!}
                                 @endpermission
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpermission
@endsection
@section('scripts')
    {!! Html::script('js/permisos.js' !!}
@endsection
