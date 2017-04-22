<?php
/* @var $this DetailBankController */
/* @var $model DetailBank */

$this->breadcrumbs=array(
	'Detail Banks'=>array('index'),
	$model->id_detailbank,
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('detailBank/admin/'.$model->id_user)),
);

?>

<h1>View DetailBank #<?php echo $model->id_detailbank; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idBank.name_bank',
		'name_account',
		'number_bank',
		'location_bank',
		'status',
	),
)); ?>
