<?php
/* @var $this BankController */
/* @var $model Bank */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_bank'); ?>
		<?php echo $form->textField($model,'id_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_bank'); ?>
		<?php echo $form->textField($model,'name_bank',array('size'=>45,'maxlength'=>45)); ?>
	</div>



	<div class="row">
		<?php echo $form->label($model,'image_bank'); ?>
		<?php echo $form->textArea($model,'image_bank',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->