@extends('layouts.app')

@section('content')

    <div class="container-fluid col-md-12  margin-tb">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>{{ __('Ongi etorria Gipuzkoako Ingenieritza Eskolako memoria sortzeko aplikaziora.') }}</strong></div>
                <div class="panel-body">
                     @if($passwordCambiar)
                        <div class="alert alert-danger">
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            {{ __('Aurretik zehaztutako pasahitza aldatu beharra dago.') }}
                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                            {{ __('Deberías cambiar la contraseña predefinida.') }}
                        </div>


                    @endif
                    <p>
                    </p>
                    <div>
                        <div class="col-md-6">
                            <p><stong>{{ __('Erabiltzailearen honespenak') }}:</stong> </p>
                            <p><small>{{ __('Pasahitza aldatzeko, hizkuntza ...')}}</small></p>
                            <?php //phpinfo(); ?>
                            <video controls height="170" width="auto">

                                <source src="/videos/pasahitza.mp4" type="video/mp4" />
                            </video>
                        </div>
                        <div class="col-md-6">
                            <p><stong>{{ __('Ezagutza basikoa') }}:</stong> </p>
                            <p><small>{{ __('Erregistro bat sortu')}}</small></p>
                             <video controls height="170" width="auto">
                            <source src="/videos/basicos.mp4" type="video/mp4" />
                        </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
