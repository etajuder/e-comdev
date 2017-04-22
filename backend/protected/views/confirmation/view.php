<?php
/* @var $this ConfirmationController */
/* @var $model Confirmation */

$this->breadcrumbs=array(
	'Confirmations'=>array('index'),
	$model->id_confirmation,
);

$this->menu=array(
	array('label'=>'List Confirmation', 'url'=>array('index')),
	array('label'=>'Create Confirmation', 'url'=>array('create')),
	array('label'=>'Update Confirmation', 'url'=>array('update', 'id'=>$model->id_confirmation)),
	array('label'=>'Delete Confirmation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_confirmation),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Confirmation', 'url'=>array('admin')),
);
?>

<h1>View Confirmation #<?php echo $model->id_confirmation; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_confirmation',
		'id_user',
		'id_post',
		'id_bank',
		'amount',
		'note',
		'file_confirm',
		'created_at',
	),
)); ?>
