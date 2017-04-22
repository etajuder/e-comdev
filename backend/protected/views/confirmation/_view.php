<?php
/* @var $this ConfirmationController */
/* @var $data Confirmation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_confirmation')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_confirmation), array('view', 'id'=>$data->id_confirmation)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_user')); ?>:</b>
	<?php echo CHtml::encode($data->id_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_post')); ?>:</b>
	<?php echo CHtml::encode($data->id_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_bank')); ?>:</b>
	<?php echo CHtml::encode($data->id_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_confirm')); ?>:</b>
	<?php echo CHtml::encode($data->file_confirm); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	*/ ?>

</div>