<?php
/* @var $this DetailBankController */
/* @var $data DetailBank */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_detailbank')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_detailbank), array('view', 'id'=>$data->id_detailbank)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bank')); ?>:</b>
	<?php echo CHtml::encode($data->id_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_account')); ?>:</b>
	<?php echo CHtml::encode($data->name_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_bank')); ?>:</b>
	<?php echo CHtml::encode($data->number_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location_bank')); ?>:</b>
	<?php echo CHtml::encode($data->location_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>