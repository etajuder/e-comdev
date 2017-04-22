<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id_user=>array('view','id'=>$model->id_user),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id_user)),
	array('label'=>'Manage User', 'url'=>array('admin')),
	array('label'=>'Add Bank', 'url'=>array('/DetailBank/create/','id'=>$model->id_user)),
	array('label'=>'List Bank', 'url'=>array('/DetailBank/admin/','id'=>$model->id_user)),
);
?>

<h1>Update User <?php echo $model->id_user; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>