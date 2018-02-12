<span class= "{{ $attr['claseSpan'] }} mostraOcultarInput" data-nomDiv = "{{ $nombreCampo }}{{ $valorId }}"  id = "{{ $nombreCampo}}{{$valorId.'_t'}}" >
    @if( isset( $attr['esTelefono']) )
        @if(!empty($valorNombre))
            <a class="btn btn-warning btn-sm" href="tel:{{$valorNombre}}">
              <i class="fa fa-phone" aria-hidden="true"></i> {{$valorNombre}}
            </a>
        @endif
    @elseif  (isset( $attr['esEmail']) )
        @if(!empty($valorNombre))
            <a class="btn btn-warning btn-sm" href='mailto:{{$valorNombre}}'><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$valorNombre}}</a>
         @endif
    @else
        {{$valorNombre}}
    @endif
</span>
{{-- Si algun dia queremos poner permiso existe este campo --}}
@if ($clasePermiso)
    {!!
        \Form::text(
            $nombreCampo.$valorId,
            $valorNombre,
            [
                'id'               => $nombreCampo.$valorId,
                'placeholder'      => isset($attr['placeholder'])?$attr['placeholder']: '',
                'class'            => 'mostraOcultarInput guardarEnBDInput form-control input-sm '.( empty($valorNombre) ? (isset($attr['siVacio']) ? $attr['siVacio'] : ''):$attr['claseInput']) ,
                'data-nomDiv'      => $nombreCampo.$valorId.'_t',
                'data-nombreTabla' => $nombreTabla,
                'data-nombreId'    => $nombreId,
                'data-nombreCampo' => $nombreCampo,
                'data-valorId'     => $valorId
            ]
        );
    !!}
@endif