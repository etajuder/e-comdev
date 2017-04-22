<?php
/* @var $this DetailBankController */
/* @var $model DetailBank */

$this->breadcrumbs=array(
	'Detail Banks'=>array('index'),
	$model->id_detailbank=>array('view','id'=>$model->id_detailbank),
	'Update',
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('detailBank/admin/'.$model->id_user)),
);

?>

<h1>Update DetailBank <?php echo $model->id_detailbank; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>