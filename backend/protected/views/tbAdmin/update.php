<?php
/* @var $this TbAdminController */
/* @var $model TbAdmin */

$this->breadcrumbs=array(
	'Tb Admins'=>array('index'),
	$model->id_admin=>array('view','id'=>$model->id_admin),
	'Update',
);

$this->menu=array(
	array('label'=>'List TbAdmin', 'url'=>array('index')),
	array('label'=>'Create TbAdmin', 'url'=>array('create')),
	array('label'=>'View TbAdmin', 'url'=>array('view', 'id'=>$model->id_admin)),
	array('label'=>'Manage TbAdmin', 'url'=>array('admin')),
);
?>

<h1>Update TbAdmin <?php echo $model->id_admin; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>