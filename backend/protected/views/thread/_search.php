<?php
/* @var $this ThreadController */
/* @var $model Thread */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_thread'); ?>
		<?php echo $form->textField($model,'id_thread'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_thread'); ?>
		<?php echo $form->textField($model,'name_thread',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_thread'); ?>
		<?php echo $form->textField($model,'url_thread',array('size'=>60,'maxlength'=>64)); ?>
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