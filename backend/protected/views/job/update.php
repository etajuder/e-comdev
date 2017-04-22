<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->id_job=>array('view','id'=>$model->id_job),
	'Update',
);

$this->menu=array(
	array('label'=>'List Job', 'url'=>array('index')),
	array('label'=>'Create Job', 'url'=>array('create')),
	array('label'=>'View Job', 'url'=>array('view', 'id'=>$model->id_job)),
	array('label'=>'Manage Job', 'url'=>array('admin')),
);
?>

<h1>Update Job <?php echo $model->id_job; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>