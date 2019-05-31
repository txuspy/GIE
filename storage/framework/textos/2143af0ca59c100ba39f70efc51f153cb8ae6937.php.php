<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'programasDeIntercambio.search', 'method'=>'POST' )); ?>

   <div>
		<div class="col-sm-6 ">
              <div class="form-group has-error">
                <label><strong>Aktibitatea:</strong></label>
                <?php if($errors->has('actividad_eu')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('actividad_eu', null, array('placeholder' => 'Aktibitea','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )); ?>

            </div>
        </div>

        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Actividad :</strong></label>
                <?php echo Form::text('actividad_es', null, array('placeholder' => 'Actividad','class' => 'form-control buscadorProgramasDeIntercambio', 'data-tipo'  => $tipo )); ?>

            </div>
        </div>
        <div>
            <div class="col-sm-6 ">
                  <div class="form-group has-error">
                    <label><strong><?php echo e(__('Noiztik')); ?>:</strong></label>
                    <?php if($errors->has('desde')): ?>
                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                    <?php endif; ?>
                    <?php echo Form::text('desde',  null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

                </div>
            </div>
    		<div class="col-sm-6 ">
                <div class="form-group">
                    <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
                    <?php echo Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addMonths(6)->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

                </div>
            </div>
        </div>

		<div class="col-sm-6 ">
              <div class="form-group has-error">
                <label><strong><?php echo e(__('Tokia')); ?>:</strong></label>
                <?php if($errors->has('lugar')): ?>
                    <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo Form::text('lugar', null, array('placeholder' => 'University of Cambridge, Cambridge, UK','class' => 'form-control')); ?>

            </div>
        </div>


		<div class="row" style="margin:1px;">
			<div class="col-sm-6">
				<label>
					<strong>
						<?php if( $tipo  == 'azp' ): ?>
							<?php echo e(__('IIP / AZP')); ?>

						<?php else: ?>
							<?php echo e(__('Irakaslea(k)')); ?>:
						<?php endif; ?>
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
	            	<?php echo e(Form::hidden('tipo', $tipo)); ?>

	            	<br><br>
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