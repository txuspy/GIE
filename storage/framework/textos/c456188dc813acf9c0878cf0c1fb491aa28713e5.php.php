<?php $__env->startSection('content'); ?>
  	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2><?php echo e(__('Word Sortu')); ?></h2>
				</div>
			</div>
		</div>
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
		<!--<div class="alert alert-success">
			<p><?php echo e(__('Urte oso bat, aukeratzen den urtetik aurrera izango da')); ?></p>
		</div>-->
	<?php echo Form::open(array('url' => App\Lib\Functions::parseLang().'/word' , 'method' => 'post', 'class' =>'form-horizontal')); ?>

<div style="margin:45px;">


	<div class="row" >
        <div class="col-xs-4">
             <div class="form-group">
	            <label><strong><?php echo e(__('Hasiera Data')); ?> (*):</strong></label>
	            <?php if($errors->has('desde')): ?>
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            <?php endif; ?>
	            <?php echo Form::text('desde', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->subYears(1)->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

	        </div>
        </div>
    </div>
     <div class="row" >
        <div class="col-xs-4">
             <div class="form-group">
	            <label><strong><?php echo e(__('Bukatze Data')); ?> (*):</strong></label>
	            <?php if($errors->has('hasta')): ?>
	                <i class="fa fa-times alert alert-danger" style='padding:2px; margin:0;' aria-hidden="true"></i>
	            <?php endif; ?>
	            <?php echo Form::text('hasta', null, array('placeholder' => \Carbon\Carbon::now('Europe/Madrid')->format('Y-m-d') ,'class' => 'datepicker form-control ')); ?>

	        </div>
        </div>
    </div>
 	<div class="row">
		<div class="col-xs-4 ">
            <div class="form-group">
                <label><strong><?php echo e(__('Atal')); ?> :</strong></label>
                <i class="fa fa-info-circle mostarSelect" title="<?php echo e(__('Atal ezberdinak nahi badituzu, sakatu')); ?>"></i>
                <?php echo Form::select('secciones[]',
                [
	                '2' => __('Postgrados'),
	                '3' => __('Formaciones'),
	                '4' => __('Programas de intercambio'),
	                '5' => __('Visitas'),
	                '6' => __('Grupo de investigacion'),
	                '7' => __('Tesis'),
	                '9' => __('Equipamiento Nuevo'),
	                '10' => __('Proyectos'),
	                '11' => __('Congresos'),
	                '12' => __('Publicaciones')
                ] , [2,3,4,5,6,7,9,10,11,12], ['multiple'=>'multiple', 'id' =>'secciones', 'class' => 'form-control chosen-type ocultar']); ?>


            </div>
            <script>
				$(".mostarSelect").click(function() {
					$("#secciones").toggle();
				});
			</script>
        </div>
    </div>

    <?php if(\Auth::user()->hasRole('owner') OR \Auth::user()->hasRole('admin')): ?>
    	<div class="row">
			<div class="col-xs-4 ">
	            <div class="form-group">
	                <label><strong><?php echo e(__('Erabiltzaileak')); ?> :</strong></label>
	                <i class="fa fa-info-circle mostarSelect" title="<?php echo e(__('Erabiltzaile ezberdinak nahi badituzu, sakatu')); ?>"></i>
	                <?php echo Form::select('usuarios[]',
	                [
		                'todos' => __('denak'),
		                'unico' =>  __('zu')." ( ".Auth::user()->name." )"

	                ] , ['todos'], ['multiple'=>'multiple', 'id' =>'usuarios', 'class' => 'form-control chosen-type ocultar']); ?>

	            </div>
	            <script>
					$(".mostarSelect").click(function() {
						$("#usuarios").toggle();
					});
				</script>
	        </div>
	    </div>
    <?php endif; ?>

    <div class="row">
        <div>
			<button type="submit" class="btn btn-primary"><i class="fa fa-plus" title ="<?php echo e(__('Word sortu')); ?>"></i> <?php echo e(__('Word sortu')); ?></button>
        </div>
        <script type="text/javascript">
			$('.date-year').datepicker({
			    minViewMode: 2,
			    format     : 'yyyy',
			});
			$('.date-mes').datepicker({
			    minViewMode: 1,
			    format     : 'mm',
			    language: "<?php echo e(\Session::get('locale')); ?>"
			});
		</script>
	<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>