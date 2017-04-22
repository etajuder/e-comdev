<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_post'); ?>
		<?php echo $form->textField($model,'id_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url_post'); ?>
		<?php echo $form->textField($model,'url_post',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tags'); ?>
		<?php echo $form->textArea($model,'tags',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_type'); ?>
		<?php echo $form->textField($model,'post_type',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_time'); ?>
		<?php echo $form->textField($model,'post_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_open'); ?>
		<?php echo $form->textField($model,'time_open'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time_close'); ?>
		<?php echo $form->textField($model,'time_close'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'viewer'); ?>
		<?php echo $form->textField($model,'viewer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_update_time'); ?>
		<?php echo $form->textField($model,'post_update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_location'); ?>
		<?php echo $form->textField($model,'id_location'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_category'); ?>
		<?php echo $form->textField($model,'id_category'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_video'); ?>
		<?php echo $form->textField($model,'id_video',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'video_thumbnail'); ?>
		<?php echo $form->textArea($model,'video_thumbnail',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'amount_label'); ?>
		<?php echo $form->textField($model,'amount_label',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->