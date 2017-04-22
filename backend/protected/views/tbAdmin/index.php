<?php
/* @var $this TbAdminController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tb Admins',
);

$this->menu=array(
	array('label'=>'Create TbAdmin', 'url'=>array('create')),
	array('label'=>'Manage TbAdmin', 'url'=>array('admin')),
);
?>

<h1>Tb Admins</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
