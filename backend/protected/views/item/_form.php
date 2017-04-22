<?php
/* @var $this ItemController */
/* @var $model Item */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name_item'); ?>
		<?php echo $form->textField($model,'name_item',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url_item'); ?>
		<?php echo $form->textField($model,'url_item',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'url_item'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'viewer'); ?>
		<?php echo $form->textField($model,'viewer'); ?>
		<?php echo $form->error($model,'viewer'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->