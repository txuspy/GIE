<span class= "{{ $attr['claseSpan'] }} mostraOcultarInput" data-nomDiv = "{{ $nombreCampo }}{{ $valorId }}"  id = "{{ $nombreCampo}}{{$valorId.'_t'}}" >{{$valorNombre}}</span>
@if ($clasePermiso)
    {!!
        \Form::textarea(
            $nombreCampo.$valorId,
            $valorNombre,
            [
                'size'             => isset($size)?$size: '30x5',
                'id'               => $nombreCampo.$valorId,
                'placeholder'      => isset($attr['placeholder'])?$attr['placeholder']: '',
                'class'            => 'mostraOcultarInput guardarEnBDInput form-control input-sm '.( !empty($valorNombre)?$attr['claseInput']: ''),
                'data-nomDiv'      => $nombreCampo.$valorId.'_t',
                'data-nombreTabla' => $nombreTabla,
                'data-nombreId'    => $nombreId,
                'data-nombreCampo' => $nombreCampo,
                'data-valorId'     => $valorId
            ]
        );
    !!}
@endif

