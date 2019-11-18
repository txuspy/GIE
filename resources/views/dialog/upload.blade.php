

<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<form action="" enctype="multipart/form-data" method="POST" id="ajax-form">
		<div class="modal-dialog" role="document">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">{{ __('Upload File') }}</h4>
				</div>
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				<img src="/images/{{ Session::get('path') }}">
				@endif

				<div class="modal-body">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
					<input type="hidden" id="attrId" name="attrId">
					<input type="hidden" id="tipo" name="tipo">
					<input type="hidden" id="tipoArchivo" name="tipoArchivo">
					<input type="hidden" id="cuantosArchivos" name="cuantosArchivos" value='1'>
					<div  class="form-group" >
						<div class="form-group" id="datosFormulario">
							{!! Form::label('archivo1','Nombre: ' , ['class' =>'col-lg-3 control-label']) !!}
							{!! Form::file('archivo1', ['id' => 'archivo1', 'class' => 'filestyle', 'data-icon'=> 'false', 'placeholder' => 'Examina']) !!}
						</div>
						<div class="row" id="loading" style="margin:35px;">
							<h3>Loading data... Please wait.</h3>
							<div class="progress progress-striped active page-progress-bar">
								<div class="progress-bar" style="width: 100%;"></div>
								<div class="percent">0%</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					{!!link_to('#', $title='Upload', $attributes = ['id'=>'upload', 'class'=>'btn btn-primary'], $secure = null)!!}
					{!!link_to('#', $title='Add', $attributes = ['id'=>'addFile', 'class'=>'btn btn-info'], $secure = null)!!}
				</div>
			</div>
		</div>
	</form>
</div>
