<?php $__env->startSection('content'); ?>
    <?php echo Breadcrumbs::render('formaciones', $tipo, $modo); ?>

	<div class="panel panel-default">
        <?php if(count($errors) > 0): ?>
    		<div class="alert alert-danger">
    			<strong>Whoops!</strong> <?php echo e(__('Akats batzuk daude ')); ?><br><br>
    			<ul>
    				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    					<li><?php echo e($error); ?></li>
    				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    			</ul>
    		</div>
    	<?php endif; ?>
        <div class="panel-body">
            <div class="col-sm-12 margin-tb">
		        <div class="pull-left">
	           		<h2>
						<?php if( $tipo == 'PDI' ): ?>
							<?php echo e(__('IIPko formazioa')); ?>

						<?php else: ?>
							<?php echo e(__('AZKko formazioa')); ?>

						<?php endif; ?>
						<?php if( $modo ): ?>
							- <?php echo e(__('Jasotakoa')); ?>

						<?php else: ?>
							- <?php echo e(__('Emandakoa')); ?>

						<?php endif; ?>
					</h2>
		        </div>
		        <div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('formaciones.index', ['tipo'  => $tipo , 'modo'  => $modo])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
	        </div>

			<?php echo Form::open(array('route' => 'formaciones.store','method'=>'POST', 'class'=>'form' )); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong><?php echo e(__('Ikastaroa')); ?> (*):</strong></label>
		                 <?php if($errors->has('titulo_eu')): ?>
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    <?php endif; ?>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' =>  __('Ikastaroa') ,'class' => 'form-control', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group has-error">
		                <label><strong><?php echo e(__('Hasiera-Data')); ?> (*):</strong></label>
		                <?php if($errors->has('fecha')): ?>
	                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	                    <?php endif; ?>
		                <?php echo Form::text('fecha', null , array('placeholder' =>  \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d')  ,'class' => 'datepicker  form-control')); ?>

		            </div>
		        </div>
		       <!-- <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong> :</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Curso','class' => 'form-control buscadorFormaciones', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

		            </div>
		        </div>-->
		    </div>
			<?php if( $modo == 'recibir' ): ?>
			    <div>
					<div class="col-sm-6 ">
			            <div class="form-group has-error">
			                <label><strong>Antolatzailea(k) (*):</strong></label>
			                <?php if($errors->has('organizador_eu')): ?>
		                        <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
		                    <?php endif; ?>
			                <?php echo Form::text('organizador_eu', null, array('placeholder' => 'Antolatzailea(k)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

			            </div>
			        </div>
			        <div class="col-sm-6 ">
			            <div class="form-group">
			                <label><strong>Organizador(es) :</strong></label>
			                <?php echo Form::text('organizador_es', null, array('placeholder' => 'Organizador(es)','class' => 'form-control ', 'data-tipo'  => $tipo , 'data-modo'  => $modo)); ?>

			            </div>
			        </div>
			    </div>
			<?php endif; ?>
			<div>

				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Tokia')); ?> :</strong></label>
		                <?php echo Form::text('lugar', null, array('id' =>'lugar', 'placeholder' => 'University of Cambridge, Cambridge, UK' ,'class' => 'form-control ')); ?>

		            </div>
		            <p><a class='btn btn-info lugar' data-valor="UPV/EHU, Gipuzkoako Ingenieritza Eskola">UPV/EHU, Gipuzkoako Ingenieritza Eskola</a>
		            <a class='btn btn-info lugar' data-valor="GIE-Donostia">GIE-Donostia</a>
		            <a class='btn btn-info lugar' data-valor="GIE-Eibar">GIE-Eibar</a>
		            <a class='btn btn-info lugar' data-valor="SAE/HELAZ ( UPV/EHU )">SAE/HELAZ ( UPV/EHU )</a>
		            <a class='btn btn-info lugar' data-valor="Gipuzkoako Campusa ( UPV/EHU )">Gipuzkoako Campusa ( UPV/EHU )</a></p>
		        </div>
				<script>
					$(".lugar").click(function() {
						$("#lugar").val( $(this).attr('data-valor') );
					});
				</script>
		    </div>
		    <div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong><?php echo e(__('Iraupena')); ?> : </strong></label><small>(h)</small>
		                <?php echo Form::text('duracion', null, array('placeholder' => '10 h' ,'class' => 'form-control ')); ?>

		            </div>
		        </div>
		    </div>
		    <div>
                <div class="col-sm-12">
		    		<p><small>(*) <?php echo e(__('Derrigorrezko eremuak')); ?></small></p>
		    	</div>
	    	</div>
		    <div>
		       <div class="col-sm-12 col-sm-12 col-md-12 text-center">
		            <?php echo e(Form::hidden('tipo', $tipo)); ?>

		            <?php echo e(Form::hidden('modo', $modo)); ?>

		            <?php echo e(Form::hidden('user_id', \Auth::user()->id)); ?>

					<button type="submit" class="btn btn-success">
					   <i class="fa fa-plus" title ="<?php echo e(__('Jarraitu')); ?>"></i>  <?php echo e(__('Jarraitu')); ?>

				    </button>
		        </div>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
    <script type="text/javascript">
		$('.date-year').datepicker({
		    minViewMode: 2,
		    format     : 'yyyy'
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>