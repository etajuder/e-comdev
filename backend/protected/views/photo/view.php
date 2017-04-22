<?php
/* @var $this PhotoController */
/* @var $model Photo */

$this->breadcrumbs=array(
	'Photos'=>array('index'),
	$model->id_photo,
);

$this->menu=array(
	array('label'=>'List Photo', 'url'=>array('index')),
	array('label'=>'Create Photo', 'url'=>array('create')),
	array('label'=>'Update Photo', 'url'=>array('update', 'id'=>$model->id_photo)),
	array('label'=>'Delete Photo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_photo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Photo', 'url'=>array('admin')),
);
?>

<h1>View Photo #<?php echo $model->id_photo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_photo',
		'path',
		'time_upload',
		'description',
		'id_post',
		'thumbnail_path',
	),
)); ?>
