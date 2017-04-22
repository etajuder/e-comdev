<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_item'); ?>
		<?php echo $form->textField($model,'id_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_item'); ?>
		<?php echo $form->textField($model,'name_item',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_item'); ?>
		<?php echo $form->textField($model,'url_item',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viewer'); ?>
		<?php echo $form->textField($model,'viewer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->