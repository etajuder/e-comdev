<?php
/* @var $this ItemController */
/* @var $data Item */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_item')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_item), array('view', 'id'=>$data->id_item)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_item')); ?>:</b>
	<?php echo CHtml::encode($data->name_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_item')); ?>:</b>
	<?php echo CHtml::encode($data->url_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewer')); ?>:</b>
	<?php echo CHtml::encode($data->viewer); ?>
	<br />


</div>