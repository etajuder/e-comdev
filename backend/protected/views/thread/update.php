<?php
/* @var $this ThreadController */
/* @var $model Thread */

$this->breadcrumbs=array(
	'Threads'=>array('index'),
	$model->id_thread=>array('view','id'=>$model->id_thread),
	'Update',
);

$this->menu=array(
	array('label'=>'List Thread', 'url'=>array('index')),
	array('label'=>'Create Thread', 'url'=>array('create')),
	array('label'=>'View Thread', 'url'=>array('view', 'id'=>$model->id_thread)),
	array('label'=>'Manage Thread', 'url'=>array('admin')),
);
?>

<h1>Update Thread <?php echo $model->id_thread; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>