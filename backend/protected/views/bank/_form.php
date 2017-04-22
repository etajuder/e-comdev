<?php
/* @var $this BankController */
/* @var $model Bank */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bank-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
    'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name_bank'); ?>
		<?php echo $form->textField($model,'name_bank',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name_bank'); ?>
	</div>


	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_bank'); ?>
		<?php if($this->action->id=="update"){
			echo CHtml::image(Yii::app()->request->baseUrl.'/../'.$model->image_bank,"gambar",array("width"=>100));
			}   ?>

		<?php echo $form->fileField($model,'image_bank',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'image_bank'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->