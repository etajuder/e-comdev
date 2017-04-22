<?php
/* @var $this JobController */
/* @var $data Job */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_job')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_job), array('view', 'id'=>$data->id_job)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_job')); ?>:</b>
	<?php echo CHtml::encode($data->name_job); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewer')); ?>:</b>
	<?php echo CHtml::encode($data->viewer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_url')); ?>:</b>
	<?php echo CHtml::encode($data->job_url); ?>
	<br />


</div>