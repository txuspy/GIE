@extends('layouts.app')
@section('content')
<div class="container">
    @if(\Auth::user()->hasRole('admin'))
        {!! Breadcrumbs::render('usuariosEdit', $user) !!}
    @else
       {!! Breadcrumbs::render('usuariosNOAdminVer', $user) !!}
    @endif
   @include('dialog.upload')
    @if(session()->has('firstTime'))
        <div id="msj-ok" class="alert alert-success alert-dismissible" role="alert">
    		<strong> {{ __('Lehenbiziko aldia da sartzen zarela, zure datuak ondo bete, eta pasahitza aldatu.') }}</strong>
    	</div>
    @endif

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>{{ __('Whoops!') }}</strong> {{ __('There were some problems with your input.') }}<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Izena') }}:</strong>
                {!! Form::text('name', null, array('placeholder' => __('Izena'),'class' => 'form-control')) !!}
            </div>
        </div>
		<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Abizenak') }}:</strong>
                {!! Form::text('lname', null, array('placeholder' => __('Abizenak') ,'class' => 'form-control')) !!}
            </div>
        </div>
        {{--
    	<div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Webunits') }}:</strong>
                {!! Form::text('ldap', null, array('placeholder' => __('Webunits'),'class' => 'form-control')) !!}
            </div>
        </div>
        --}}
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Posta elektronikoa') }}:</strong>
                {!! Form::text('email', null, array('placeholder' => __('Posta elektronikoa'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Pasahitza') }} :</strong>
                @if(session()->has('firstTime'))
                     <div class="alert alert-danger">
                        <strong>{{ __('Pasahitza') }}</strong>
                    </div>
                @endif
                @if(session()->has('firstTime'))
                    {!! Form::input('password', 'password', __('Pasahitza'), ['class' => 'form-control'])!!}
                @else
                    {!! Form::password('password', array('placeholder' =>  __('Pasahitza'),'class' => 'form-control')) !!}
                @endif
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            <div class="form-group">
                <strong>{{ __('Pasahitza Konfirmatu') }}:</strong>
                @if(session()->has('firstTime'))
                    <div class="alert alert-danger">
                        <strong>{{ __('Pasahitza Konfirmatu') }}</strong>
                    </div>
                @endif
                {!! Form::password('confirm-password', array('placeholder' => __('Pasahitza Konfirmatu'),'class' => 'form-control')) !!}
            </div>

        </div>
         <div class="col-xs-12">
            <div class="form-group" >
                <strong class="col-xs-3" >{{ __('Hizkuntza') }}:</strong><!-- margin left mal -->
                <div class="col-xs-9">
                    <lavel class="col-xs-3">{{ __('Castellano') }} {{ Form::radio("lng", "es") }}</lavel>
                    <lavel class="col-xs-3">{{ __('Euskara') }} {{ Form::radio("lng", "eu") }}</lavel>
                </div>
            </div>
        </div>
        @role('admin')

            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
                    <strong>{{ __('Errola') }}:</strong>
                    {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
        @endrole
        <div class="col-xs-10 col-sm-10 col-md-10 text-center">
				<button type="submit" class="btn btn-primary">{{ __('Bidali') }}</button>
        </div>
	</div>
	{!! Form::close() !!}
	</div>
	<div id="dialog2" title="PASAHITZA ALDATU / CAMBIAR PASSWORD" class='ocultar' >
      @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{!! $error !!}</p>
            @endforeach
        </div>
    @endif
    </div>
	<script type="text/javascript" >
	$( function() {
	     if ( $( ".alert-danger" )[0] ) {
	         alert("fff");
            $("#dialog2").show();
            $("#dialog2").dialog({
				modal: true,
				resizable: false,
				width: 600
			});
        }
    } );

	</script>
@endsection

