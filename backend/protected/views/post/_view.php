<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_post')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_post), array('view', 'id'=>$data->id_post)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url_post')); ?>:</b>
	<?php echo CHtml::encode($data->url_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_type')); ?>:</b>
	<?php echo CHtml::encode($data->post_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_time')); ?>:</b>
	<?php echo CHtml::encode($data->post_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_status')); ?>:</b>
	<?php echo CHtml::encode($data->post_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_open')); ?>:</b>
	<?php echo CHtml::encode($data->time_open); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_close')); ?>:</b>
	<?php echo CHtml::encode($data->time_close); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('viewer')); ?>:</b>
	<?php echo CHtml::encode($data->viewer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_update_time')); ?>:</b>
	<?php echo CHtml::encode($data->post_update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_location')); ?>:</b>
	<?php echo CHtml::encode($data->id_location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_category')); ?>:</b>
	<?php echo CHtml::encode($data->id_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_video')); ?>:</b>
	<?php echo CHtml::encode($data->id_video); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('video_thumbnail')); ?>:</b>
	<?php echo CHtml::encode($data->video_thumbnail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_label')); ?>:</b>
	<?php echo CHtml::encode($data->amount_label); ?>
	<br />

	*/ ?>

</div>