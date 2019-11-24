<?php $__env->startSection('content'); ?>
   <?php echo Breadcrumbs::render('divulgacionEdit', $divulgacion); ?>

   <div class="panel panel-default">
       <?php if($message = Session::get('success')): ?>
		<div class="alert alert-success">
			<p><?php echo e($message); ?></p>
		</div>
    	<?php endif; ?>
    	<?php if(count($errors) > 0): ?>
    		<div class="alert alert-danger">
    			<strong><?php echo e(__('Whoops!')); ?></strong> <?php echo e(__('There were some problems with your input.')); ?><br><br>
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
		        	<?php if( $divulgacion->tipo == 'prensa' ): ?>
						<h2><?php echo e(__('Prentsa')); ?></h2>
					<?php else: ?>
						<h2><?php echo e(__('Ekitaldiak')); ?></h2>
					<?php endif; ?>
		        </div>
			<div class="pull-right">
		            <a class="btn btn-primary" href="<?php echo e(route('divulgacion.index', ['tipo'  => $divulgacion->tipo ])); ?>"><i class="fa fa-reply" title="<?php echo e(__('Atzera')); ?>"></i></a>
		        </div>
		    </div>

			
			<?php echo Form::model($divulgacion, ['method' => 'PUT','route' => ['divulgacion.update', $divulgacion->id]]); ?>

			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Izenburua (*):</strong></label>
		                <?php echo Form::text('titulo_eu', null, array('placeholder' => 'Izenburua','class' => 'form-control')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Titulo:</strong></label>
		                <?php echo Form::text('titulo_es', null, array('placeholder' => 'Titulo','class' => 'form-control')); ?>

		            </div>
		        </div>
		    </div>
			<div>
				<div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Deskripzioa (*):</strong></label>
		                <?php echo Form::textarea('desc_eu', null, array('placeholder' => 'Deskripzioa','class' => 'form-control summernote')); ?>

		            </div>
		        </div>
		        <div class="col-sm-6 ">
		            <div class="form-group">
		                <label><strong>Descripción:</strong></label>
		                <?php echo Form::textarea('desc_es', null, array('placeholder' => 'Descripción','class' => 'form-control summernote')); ?>

		            </div>
		          
		        </div>
		    </div>
		    <div class="row" style="margin:1px;">
                <div class="col-sm-6 ">
                     <div class="form-group has-error">
                        <label><strong><?php echo e(__('Data')); ?> (*):</strong>  </label>
		                <?php echo Form::text('fecha',  null , array('placeholder' => __('Desde') ,'class' => 'datepicker form-control')); ?>

                    </div>
                </div>
                <?php if( $divulgacion->tipo == 'prensa' ): ?>
            		<div class="col-sm-6 ">
                        <label><strong><?php echo e(__('Noiz arte')); ?> :</strong></label>
				            <?php echo Form::text('hasta', null , array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->addWeek('1')->format('Y-m-d') ,'class' => 'datepicker form-control')); ?>

                	
                    </div>
                <?php endif; ?>
            </div>
            
		     <?php if( $divulgacion->tipo == 'prensa' ): ?>
            
                 <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong><?php echo e(__('Ekitaldiaren webgunea')); ?> :</strong></label>
                            <?php if($errors->has('web')): ?>
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo Form::text('web', null, array('placeholder' => 'Ekitaldiaren webgunea','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)); ?>

                      
                        </div>
                    </div>
            	
                </div>
            <div class="row"></div>
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong><?php echo e(__('Komunikabidean agertu da')); ?> :</strong></label>
                            <?php if($errors->has('komunikabideetanPublikatua')): ?>
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo Form::select('komunikabideetanPublikatua',   [0 => __('Ez'), 1 => __('Bai') ],  1 ,   ['class' => 'form-control'] ); ?>

                        </div>
                    </div>
            	
                </div>
                <div class="row"></div>
                <div>
                    <div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong><?php echo e(__('Komunikabidea')); ?> :</strong></label>
                            <?php if($errors->has('komunikabidea')): ?>
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo Form::text('komunikabidea', null, array('placeholder' => 'Komunikabidea','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)); ?>

                        </div>
                    </div>
            		<div class="col-sm-6 ">
                         <div class="form-group has-error">
                            <label><strong><?php echo e(__('Komunikabidearen esteka')); ?> :</strong></label>
                           <?php if($errors->has('komunikabideWeb')): ?>
                                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php echo Form::text('komunikabideWeb', null, array('placeholder' => 'Komunikabidearen esteka','class' => 'form-control ', 'data-tipo'  => $divulgacion->tipo)); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
		    <div class="col-md-12 col-sm-12 col-md-12 text-center">
				<?php echo e(Form::hidden('tipo', $divulgacion->tipo)); ?>

				<button type="submit" class="btn btn-primary"><i class="fa fa-refresh" title="<?php echo e(__('Gorde')); ?>"></i> <?php echo e(__('Gorde')); ?></button>
			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>