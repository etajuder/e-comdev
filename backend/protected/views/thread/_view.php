<?php
/* @var $this ThreadController */
/* @var $data Thread */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_thread')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_thread), array('view', 'id'=>$data->id_thread)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_thread')); ?>:</b>
	<?php echo CHtml::encode($data->name_thread); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_thread')); ?>:</b>
	<?php echo CHtml::encode($data->url_thread); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewer')); ?>:</b>
	<?php echo CHtml::encode($data->viewer); ?>
	<br />


</div>