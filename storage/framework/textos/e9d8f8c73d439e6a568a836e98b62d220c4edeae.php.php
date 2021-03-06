<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'visitas.search', 'method'=>'POST' )); ?>

   <div>
		<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Aktibitatea:</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Proiektua','class' => 'form-control buscadorVisitas')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Actividad:</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Proyecto','class' => 'form-control buscadorVisitas')); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Tokia')); ?>:</strong></label>
		                <?php echo Form::text('lugar', null , array('placeholder' => 'University of Cambridge, Cambridge, UK' ,'class' => ' form-control')); ?>

		            </div>
		        </div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Data')); ?>:</strong></label>
		                <?php echo Form::text('fecha', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

		            </div>
		        </div>
		    </div>

		</div>
		<div class="row" style="margin:1px;">
			<div class="col-sm-6">
				<label>
					<strong>
					<?php echo e(__('Irakaslea(k)')); ?>:

					</strong>
				</label>
			 	<?php echo e(Form::text('formacionesAutores', '', [
			        'id'           =>'formacionesAutores',
			        'placeholder'  =>__('Egilea bilatu'),
			        'class'        =>'form-control buscadorDeAutor inputAutores',
			        'data-idDialog'=>'dialogFormacionesAutores',
			        'data-carpeta' =>'autores',
			        'data-tipo'    =>'formaciones',
			        'data-modo'    =>'formaciones',
			        'data-idUl'    =>'ulFormacionesAutores',

			 	]
			 	)); ?>

			 	<?php echo e(Form::hidden('id_autor', '', ['id' => 'id_autor' ])); ?>

		 	</div>
		</div>

	    <div class="row" style="margin:1px;">
	        <div class="col-sm-12">
	            <div class="form-group">
<br>
	    			<button type="submit" class="btn btn-primary col-sm-12 "><i class="fa fa-search" title ="<?php echo e(__('Bilatu')); ?>"></i>  <?php echo e(__('Bilatu')); ?></button>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php echo Form::close(); ?>

</div>