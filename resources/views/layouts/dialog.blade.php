<div id="{{ $idDialog }}" title="{{ $tituloContenido }}" style="display:none;" >
	<form id="{{ $idForm }}">
			<div class="col-xs-12">
				<div class="form-group">
					<div class="col-xs-3">
						<label for="nombreDialog"  style="padding-top:8px;">{{ __('Izena')}}: </label>
					</div>
					<div class="col-xs-2">
						<input type="text" name="nombreDialog" value="" class="text ui-widget-content ui-corner-all nombreDialog">
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<div class="col-xs-3">
						<label for="apellidoDialog" style="padding-top:8px;">{{ __('Abizena')}}: </label>
					</div>
					<div class="col-xs-2">
						<input type="text" name="apellidoDialog" value="" class="text ui-widget-content ui-corner-all apellidoDialog">
					</div>
				</div>
			</div>
	</form>
</div>