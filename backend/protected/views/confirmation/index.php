<?php
/* @var $this ConfirmationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Confirmations',
);

$this->menu=array(
	array('label'=>'Create Confirmation', 'url'=>array('create')),
	array('label'=>'Manage Confirmation', 'url'=>array('admin')),
);
?>

<h1>Confirmations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
