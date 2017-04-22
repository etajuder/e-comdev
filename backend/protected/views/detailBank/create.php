<?php
/* @var $this DetailBankController */
/* @var $model DetailBank */

$this->breadcrumbs=array(
	'Detail Banks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('User/update/'.$id_user)),
	array('label'=>'List Banks', 'url'=>array('detailBank/admin/'.$id_user)),
);
?>

<h1>Create DetailBank</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id_user'=>$id_user)); ?>