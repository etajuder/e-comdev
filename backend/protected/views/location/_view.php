<?php
/* @var $this LocationController */
/* @var $data Location */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_location')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_location), array('view', 'id'=>$data->id_location)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_location')); ?>:</b>
	<?php echo CHtml::encode($data->name_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewer')); ?>:</b>
	<?php echo CHtml::encode($data->viewer); ?>
	<br />


</div>