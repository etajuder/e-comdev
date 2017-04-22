<?php
/* @var $this PhotoController */
/* @var $model Photo */

$this->breadcrumbs=array(
	'Photos'=>array('index'),
	$model->id_photo=>array('view','id'=>$model->id_photo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Photo', 'url'=>array('index')),
	array('label'=>'Create Photo', 'url'=>array('create')),
	array('label'=>'View Photo', 'url'=>array('view', 'id'=>$model->id_photo)),
	array('label'=>'Manage Photo', 'url'=>array('admin')),
);
?>

<h1>Update Photo <?php echo $model->id_photo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>