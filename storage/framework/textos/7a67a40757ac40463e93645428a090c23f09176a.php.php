<?php $__env->startSection('content'); ?>
    @permission('permission-list')
        <div class="container">
            <?php echo Breadcrumbs::render('permisosEditar', $permiso); ?>

        	<div class="row">
        	    <div class="col-lg-12 margin-tb">
        	        <div class="pull-left">
        	            <h2><?php echo e(__('Permission Management')); ?> </h2>
        	        </div>
        	      <div class="pull-right">
	            <a class="btn btn-primary" href="<?php echo e(route('permisos.ver')); ?>"> Back</a>
	        </div>
        	    </div>
        	</div>
        	<?php if($message = Session::get('success')): ?>
        		<div class="alert alert-success">
        			<p><?php echo e($message); ?></p>
        		</div>
        	<?php endif; ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo e(__('Permisos')); ?>

                       </div>
                        <div class="panel-body">
                    		<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                        		<strong> <?php echo e(__('Permission Deleted.')); ?></strong>
                    		</div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Nombre')); ?></th>
                                        <th><?php echo e(__('Dysplay Name')); ?></th>
                                        <th><?php echo e(__('Descripción')); ?></th>
                                    </tr>
                                </thead>
                                @permission('permission-create')
                                    <?php echo Form::open(); ?>

                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="token">
                                    <input type="hidden" name="_token" value="<?php echo e($permiso->id); ?>" id="token">
                                    <input type="hidden" name="_URL_BASE_DEFAULT" value="<?php echo e(env('URL_BASE_DEFAULT')); ?>" id="URL_BASE_DEFAULT">
                                        <tr>
                                            <td><?php echo Form::text('name', $permiso->name , [
                                            'id'         => 'name',
                                            'class'      =>'form-control editarPermiso',
                                            'placeholder'=> 'Ingresa nombre',
                                            'nombreCampo'=> 'name',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id ,
                                            ]); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('display_name', $permiso->display_name , [
                                                'id' => 'display_name',
                                                'class'=>'form-control editarPermiso',
                                                'placeholder'=> ' Ingresa display name',
                                                'nombreCampo'=> 'display_name',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id , ]); ?>

                                                </td>
                                            <td><?php echo Form::text('description', $permiso->description, ['id' => 'description', 'class'=>'form-control editarPermiso', 'placeholder'=> ' Ingresa display name',
                                            'nombreCampo'=> 'description',
                                            'token'        => csrf_token(),
                                            'valorId'      => $permiso->id , ]); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php echo Form::close(); ?>

                                 @endpermission
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpermission
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo Html::script('js/permisos.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>