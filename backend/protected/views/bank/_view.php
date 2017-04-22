<?php
/* @var $this BankController */
/* @var $data Bank */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bank')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_bank), array('view', 'id'=>$data->id_bank)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_bank')); ?>:</b>
	<?php echo CHtml::encode($data->name_bank); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('image_bank')); ?>:</b>
	<?php echo CHtml::encode($data->image_bank); ?>
	<br />


</div>