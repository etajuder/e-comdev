<?php
/* @var $this TbAdminController */
/* @var $model TbAdmin */

$this->breadcrumbs=array(
	'Tb Admins'=>array('index'),
	$model->id_admin,
);

$this->menu=array(
	array('label'=>'List TbAdmin', 'url'=>array('index')),
	array('label'=>'Create TbAdmin', 'url'=>array('create')),
	array('label'=>'Update TbAdmin', 'url'=>array('update', 'id'=>$model->id_admin)),
	array('label'=>'Delete TbAdmin', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_admin),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TbAdmin', 'url'=>array('admin')),
);
?>

<h1>View TbAdmin #<?php echo $model->id_admin; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_admin',
		'username',
		'password',
		'email',
	),
)); ?>
