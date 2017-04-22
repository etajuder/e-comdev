<?php
/* @var $this JobController */
/* @var $model Job */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_job'); ?>
		<?php echo $form->textField($model,'id_job'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_job'); ?>
		<?php echo $form->textField($model,'name_job',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viewer'); ?>
		<?php echo $form->textField($model,'viewer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_url'); ?>
		<?php echo $form->textArea($model,'job_url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->