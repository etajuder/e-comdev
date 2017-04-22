<?php
/* @var $this DetailBankController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detail Banks',
);

$this->menu=array(
	array('label'=>'Create DetailBank', 'url'=>array('create')),
	array('label'=>'Manage DetailBank', 'url'=>array('admin')),
);
?>

<h1>Detail Banks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
