@include('dialog.upload')
<div id="msj-ok" class="alert alert-success alert-dismissible" role="alert" style="display:none">
    <strong> {{ __('Upload OK.') }}</strong>
</div>
<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
    <strong> {{ __('Upload ERROR.') }}</strong>
</div>

<div class='row'>
    <div class="pull-right">
        <button class="btn btn-warning upload" tipoArchivo='imagen' tipo='{{$tipo}}'
                attrId='{{ $attrId }}'><i class="fa fa-cloud-upload" aria-hidden="true"></i> {{
            __('Upload Image')}}
        </button>
        <a class="btn btn-info" href="{{ url()->previous() }}"> Back</a>
    </div>
    <div>
        @if(count($imagenes) > 0)
        @foreach ($imagenes as $imagen)
        <div id="{{ $imagen->id_imagenes }}" class='col-md-2'>
            <img src="/images/{{$carpeta}}/{{ $imagen->nom_imagenes }}" alt="{{ $imagen->title_imagenes }}">
            <a class='btn btn-danger delete_field' tipoArchivo='imagen' tipo='{{$tipo}}' attrId='{{ $attrId }}'
               idFile='{{ $imagen->id_imagenes }}' nomFile='{{ $imagen->nom_imagenes }}'
               tamanoFile='{{ $imagen->tamano_imagenes }}' title="Delete">

                <i class="fa fa-trash-o" role="button" aria-hidden="true"
                   title="{{ __('Delete img: ') }}{{  $imagen->id_imagenes }}"></i> {{ __('Delete')}}
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>