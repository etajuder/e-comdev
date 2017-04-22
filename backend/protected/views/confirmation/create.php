<?php
/* @var $this ConfirmationController */
/* @var $model Confirmation */

$this->breadcrumbs=array(
	'Confirmations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Confirmation', 'url'=>array('index')),
	array('label'=>'Manage Confirmation', 'url'=>array('admin')),
);
?>

<h1>Create Confirmation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>