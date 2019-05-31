@include('dialog.upload')
<div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong> {{ __('Upload OK.') }}</strong>
</div>
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
    <strong> {{ __('Upload ERROR.') }}</strong>
</div>

<div class='row'>
    <div class="pull-right">
        <button class="btn btn-warning upload" tipoArchivo='archivo' tipo='{{$tipo}}'
                attrId='{{ $attrId }}'><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                {{ __('Upload File')}}</button>
            <a class="btn btn-info" href="{{ url()->previous() }}"> Back</a>
    </div>
    <div>
         @if( count($adjuntos) > 0  )
            <h2>Adjuntos</h2>
            @foreach ($adjuntos as $adjunto)
                <div id="{{ $adjunto->id_adjunto }}" class='col-md-2'>
                    <a src="/down/{{$carpeta}}/{{ $adjunto->nom_adjunto }}" target="_blank"  role="button">
                        {{ $adjunto->title_adjunto }}
                    </a>(
                    <a class='delete_field' tipoArchivo='archivo' tipo='{{$tipo}}' attrId='{{ $attrId }' idFile='{{ $adjunto->id_adjunto }}' nomFile='{{ $adjunto->nom_adjunto }}'  title="Delete" tamanoFile='0' >
                        <i class="fa fa-trash-o" role="button" aria-hidden="true" title="{{ __('Delete file: ') }}{{  $adjunto->id_adjunto }}"></i> {{ __('Delete')}}
                    </a> )
                </div>
            @endforeach
        @endif
    </div>
</div>