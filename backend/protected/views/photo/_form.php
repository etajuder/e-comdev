<?php
/* @var $this PhotoController */
/* @var $model Photo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'photo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'path'); ?>
		<?php echo $form->textArea($model,'path',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_upload'); ?>
		<?php echo $form->textField($model,'time_upload'); ?>
		<?php echo $form->error($model,'time_upload'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_post'); ?>
		<?php echo $form->textField($model,'id_post'); ?>
		<?php echo $form->error($model,'id_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thumbnail_path'); ?>
		<?php echo $form->textArea($model,'thumbnail_path',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'thumbnail_path'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->