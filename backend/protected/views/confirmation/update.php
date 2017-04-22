<?php
/* @var $this ConfirmationController */
/* @var $model Confirmation */

$this->breadcrumbs=array(
	'Confirmations'=>array('index'),
	$model->id_confirmation=>array('view','id'=>$model->id_confirmation),
	'Update',
);

$this->menu=array(
	array('label'=>'List Confirmation', 'url'=>array('index')),
	array('label'=>'Create Confirmation', 'url'=>array('create')),
	array('label'=>'View Confirmation', 'url'=>array('view', 'id'=>$model->id_confirmation)),
	array('label'=>'Manage Confirmation', 'url'=>array('admin')),
);
?>

<h1>Update Confirmation <?php echo $model->id_confirmation; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>