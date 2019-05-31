<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'publicaciones.search', 'method'=>'POST' )); ?>

	<div class="row" style="margin:1px;">
		<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Izenburua')); ?> (*):</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Titulo','class' => 'form-control buscadorPublicaciones', 'data-tipo'  => $tipo)); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">

		           <?php if( $tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('Argitaletxea')); ?> :</strong></label>
			                <?php echo Form::text('editorialRevisa',  null , array('placeholder' => __('Argitaletxea') ,'class' => 'form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('Aldizkaria')); ?> :</strong></label>
		                	<?php echo Form::text('editorialRevisa',  null , array('placeholder' => __('Aldizkaria') ,'class' => 'form-control buscadorAldikariak')); ?>

		            	</div>
		            <?php endif; ?>


		        </div>

		    </div>

		    <div class="row" style="margin:1px;">
		        <div class="col-sm-6 ">
		        	<?php if( $tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('Kapitulo')); ?> :</strong></label>
			                <?php echo Form::text('capitulo',  null , array('placeholder' => __('Kapitulo') ,'class' => ' form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('Bolumena')); ?> :</strong></label>
		                	<?php echo Form::text('volumen',  null , array('placeholder' => __('Bolumena') ,'class' => ' form-control')); ?>

		            	</div>
		            <?php endif; ?>
		        </div>
		         <div class="col-sm-6 ">
		        	<?php if( $tipo =='libros'): ?>
			            <div class="form-group">
			                <label><strong><?php echo e(__('ISBN')); ?> :</strong></label>
			                <?php echo Form::text('ISBN',  null , array('placeholder' => __('ISBN') ,'class' => ' form-control')); ?>

			            </div>
		            <?php else: ?>
		              	<div class="form-group">
		                	<label><strong><?php echo e(__('ISSN')); ?> :</strong></label>
		                	<?php echo Form::text('ISBN',  null , array('placeholder' => __('ISSN') ,'class' => ' form-control')); ?>

		            	</div>
		            <?php endif; ?>
		        </div>


		    </div>
    <div class="row" style="margin:1px;">
        <div class="col-sm-6 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Data')); ?> (*):</strong></label>
                <?php echo Form::text('year', null , array('placeholder' => __('Data') ,'class' => 'datepicker date-year form-control')); ?>

            </div>
        </div>
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Egilea(k)')); ?>:</strong></label>
        	 	<?php echo e(Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)); ?>

                <?php echo e(Form::hidden('id_autor', '', ['id' => 'id_autor' ])); ?>

	 	    </div>
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



	<script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php echo Form::close(); ?>

</div>