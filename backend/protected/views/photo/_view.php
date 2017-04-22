<?php
/* @var $this PhotoController */
/* @var $data Photo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_photo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_photo), array('view', 'id'=>$data->id_photo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_upload')); ?>:</b>
	<?php echo CHtml::encode($data->time_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_post')); ?>:</b>
	<?php echo CHtml::encode($data->id_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('thumbnail_path')); ?>:</b>
	<?php echo CHtml::encode($data->thumbnail_path); ?>
	<br />


</div>