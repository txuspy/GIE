<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'congresos.search', 'method'=>'POST' )); ?>

   <div>
		<div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Kongresua')); ?>:</strong></label>
	                <?php echo Form::text('congreso_eu', null, array('placeholder' => 'Grupo','class' => 'form-control buscadorCongresos')); ?>

	            </div>
	        </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Izenburua')); ?> :</strong></label>
	                <?php echo Form::text('conferenciaPoster', null, array('placeholder' => __('Izenburuaa') ,'class' => 'form-control')); ?>

	            </div>
	        </div>
	    </div>
		<div>
			<div class="col-xs-6 ">
		      	 <div class="form-group has-error">
		                <label><strong><?php echo e(__('Ekarpen mota')); ?> (*):</strong></label>

		                <?php echo Form::select('ekarpena',  \App\Traits\Listados::listadoEkarpena(), '0', ['id' =>'ekarpena',   'class' => 'form-control chosen-select']); ?>


		         </div>
	         </div>
	         <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Tokia')); ?> :</strong></label>
	                <?php echo Form::text('lugar', null, array('placeholder' => __('Viena, Austria'),'class' => 'form-control')); ?>

	            </div>
	        </div>
	    </div>
	    <div>
	        <div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Noiztik')); ?> :</strong></label>
	                <?php echo Form::text('desde',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

	            </div>
	        </div>
			<div class="col-xs-6 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
	                <?php echo Form::text('hasta', null , array('placeholder' => __('Hasta') ,'class' => 'datepicker form-control')); ?>

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