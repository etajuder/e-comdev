<?php
/* @var $this DetailBankController */
/* @var $model DetailBank */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_detailbank'); ?>
		<?php echo $form->textField($model,'id_detailbank'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->textField($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_bank'); ?>
		<?php echo $form->textField($model,'id_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_account'); ?>
		<?php echo $form->textField($model,'name_account',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_bank'); ?>
		<?php echo $form->textField($model,'number_bank',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location_bank'); ?>
		<?php echo $form->textArea($model,'location_bank',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->