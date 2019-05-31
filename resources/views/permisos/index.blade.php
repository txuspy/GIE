@extends('layouts.app')
@section('content')
@permission('permission-list')
<div class="container">
	{!! Breadcrumbs::render('permisos') !!}

	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<h2>{{ __('Permission Management')}} </h2>
				<div class="container">
					<a href="{{ url(App\Lib\Functions::parseLang().'/permisos/excel/xls') }}"><button class="btn btn-primary"><i class="fa fa-cloud-download" aria-hidden="true"></i> {{ __('Download xls')}} </button></a>
					<a href="{{ url(App\Lib\Functions::parseLang().'/permisos/excel/xlsx')  }}"><button class="btn btn-info"><i class="fa fa-cloud-download" aria-hidden="true"></i> {{ __('Download xlsx')}}</button></a>
					<a href="{{ url(App\Lib\Functions::parseLang().'/permisos/excel/cvs')  }}"><button class="btn btn-warning"><i class="fa fa-cloud-download" aria-hidden="true"></i>  {{ __('Download CVS')}}</button></a>
					<a href="{{ url(App\Lib\Functions::parseLang().'/permisos/pdf') }}"><button class="btn btn-default"><i class="fa fa-cloud-download" aria-hidden="true"></i>  {{ __('Download PDF')}}</button></a>
				</div>
			</div>
			<div class="pull-right">
				@permission('permission-delete')
				<a class="btn btn-danger" href="#" id="borrarPermisos"> {{ __('Delete Permision')}} </a>
				@endpermission
				<br/>&nbsp;

			</div>
		</div>
	</div>
	@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
	@endif
	@if ($message = Session::get('error'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
	@endif
	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="msj-insert" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> {{ __('Permission Created.') }}</strong>
					</div>
					<div id="msj-deleted" class="alert alert-success alert-dismissible" role="alert" style="display:none">
						<strong> {{ __('Permission Deleted.') }}</strong>
					</div>
					<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
						<strong> {{ __('Upload ERROR.') }}</strong>
					</div>
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
							@permission('permission-create')
							{!!Form::open()!!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
							<input type="hidden" name="_URL_BASE_DEFAULT" value="{{ env('URL_BASE_DEFAULT') }}" id="URL_BASE_DEFAULT">
							<tr>
								<td>{!!Form::text('name', null, ['id' => 'name', 'class'=>'form-control', 'placeholder'=> ' Ingresa nombre'])!!}
								</td>
								<td>
									{!!Form::text('display_name', null, ['id' => 'display_name', 'class'=>'form-control', 'placeholder'=> ' Ingresa display name'])!!}
								</td>
								<td>{!!Form::text('description', null, ['id' => 'description', 'class'=>'form-control', 'placeholder'=> ' Ingresa display name'])!!}</td>
								<td>{!!link_to('#', $title='Create New Permision', $attributes = ['id'=>'crearPermiso', 'class'=>'btn btn-success'] , $secure=null) !!}</td>
							</tr>
							{!!Form::close()!!}
							@endpermission
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
@endsection
@section('scripts')
{!!Html::script('/js/permisos.js')!!}
@endsection
