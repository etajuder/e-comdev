<?php
/* @var $this TbAdminController */
/* @var $model TbAdmin */

$this->breadcrumbs=array(
	'Tb Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TbAdmin', 'url'=>array('index')),
	array('label'=>'Manage TbAdmin', 'url'=>array('admin')),
);
?>

<h1>Create TbAdmin</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>