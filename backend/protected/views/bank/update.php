<?php
/* @var $this BankController */
/* @var $model Bank */

$this->breadcrumbs=array(
	'Banks'=>array('index'),
	$model->id_bank=>array('view','id'=>$model->id_bank),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bank', 'url'=>array('index')),
	array('label'=>'Create Bank', 'url'=>array('create')),
	array('label'=>'View Bank', 'url'=>array('view', 'id'=>$model->id_bank)),
	array('label'=>'Manage Bank', 'url'=>array('admin')),
);
?>

<h1>Update Bank <?php echo $model->id_bank; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>