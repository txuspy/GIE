<div id="seccionSearch" class="alert alert-info ocultar">
<?php echo Form::open(array('route' => 'tesisDoctorales.search', 'method'=>'POST' )); ?>

		<div>
		<div class="col-sm-6 ">
            <div class="form-group">
                <label><strong>Izenburua / Titulo:</strong></label>
                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control buscadorTesisDoctorales')); ?>

            </div>
        </div>
        <div class="col-sm-6 ">
            <br><br><br><br><br>
        </div>

    </div>
	<div>
		<div class="col-sm-6 ">
           <div class="form-group">
                <label><strong>Saila/ Departamento (*):</strong></label>
                <?php echo Form::select('departamento',  \App\Traits\Listados::listadoDepartamentos( \Session::get('locale') ), '', ['id' =>'departamento',   'class' => 'form-control chosen-select']); ?>

            </div>
        </div>
		<div class="col-sm-3">
            <?php echo e(Form::label('euskera', __('Euskaraz'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('euskera', 1, '', ['class' => ''])); ?>

        </div>
        <div class="col-sm-3">
           <?php echo e(Form::label('internacional', __('Nazioartekoa'), ['class'=>' control-label'] )); ?><br>
            <?php echo e(Form::checkbox('internacional', 1, '', ['class' => ''])); ?>

        </div>
	</div>


	<div class='row'>
		<div style="margin:30px;">
			<?php if($tipo=='tesisLeidas'): ?>
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong><?php echo e(__('Data')); ?> :</strong></label>
			                <?php echo Form::text('fechaLectura', '' , array('placeholder' => __('Data') ,'class' => 'datepicker form-control')); ?>

			            </div>
			        </div>
			    </div>
			    <div class="col-sm-6 "> </div>
		    <?php endif; ?>
		    <?php if($tipo=='proximaLectura'): ?>
			    <div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong><?php echo e(__('Kurtsoa')); ?> :</strong></label>
			                <span><i>( <?php echo e($tesisDoctoral->curso); ?> - <?php echo e($tesisDoctoral->curso +1); ?> )</i></span>
			                <?php echo Form::text('curso', '' , array('placeholder' => __('Kurtsoa') ,'class' => 'date-year form-control')); ?>

			            </div>
			        </div>
			    </div><div class="col-sm-6 "> </div>
		    <?php endif; ?>
		</div>
	</div>
    <div class="row" style="margin:1px;">
    	<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Arduraduna(k)')); ?> :</strong></label>
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
	 		<div class="col-sm-6">
    	    <div class="form-group">
        		<label><strong><?php echo e(__('Partaidea(k)')); ?>  :</strong></label>
        	 	<?php echo e(Form::text('postgradosAutores', '', [
    		        'id'           =>'postgradosAutores2',
    		        'placeholder'  =>__('Irakaslea bilatu'),
    		        'class'        =>'form-control buscadorDeAutor2',
    		        'data-idDialog'=>'dialogPostgradosAutores',
    		        'data-carpeta' =>'autores',
    		        'data-tipo'    =>'postgrados',
    		        'data-idUl'    =>'ulPostgradosAutores'
        	 	]
        	 	)); ?>

                <?php echo e(Form::hidden('id_autor2', '', ['id' => 'id_autor2' ])); ?>

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