<?php
/* @var $this JobController */
/* @var $model Job */

$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List job', 'url'=>array('jobs')),
	array('label'=>'Create job', 'url'=>array('createjob')),
	array('label'=>'Update Job', 'url'=>array('updatejob', 'id'=>$model->id_post)),
	array('label'=>'Delete Job', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_post),'confirm'=>'Are you sure you want to delete this job?')),
	array('label'=>'Manage job', 'url'=>array('jobs')),
);
?>

<h1><?php echo $model->title; ?></h1>
<div class="alert">
  <strong>Images</strong>.
</div>
<div class="row-fluid">
	<ul class="thumbnails">
		<?php
		foreach ($foto as $key) {
			?>

		  <li class="span2">
		    <a href="#" class="thumbnail">
		      <img src="<?=Yii::app()->request->baseUrl.'/../'.$key['thumbnail_path']; ?>" >
		    </a>
		  </li>

		<?php
		}
		?>
	</ul>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_post',
		'url_post',
		'title',
		'tags',
		'content',
		'post_type',
		array('name'=>'post_time',
                          'type'=>'html',
                          'header'=>'post_time',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>date("Y-m-d",$model->post_time),
                        ),
		'author',
		'post_status',
		'amount',
		'amount_label',
			array('name'=>'time_open',
                          'type'=>'html',
                          'header'=>'time_open',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>date("Y-m-d",$model->time_open),
                        ),
			array('name'=>'time_close',
                          'type'=>'html',
                          'header'=>'time_close',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>date("Y-m-d",$model->time_close),
                        ),
		'viewer',
		array('name'=>'post_update_time',
                          'type'=>'html',
                          'header'=>'post_update_time',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>date("Y-m-d",$model->post_update_time),
                        ),
		'idLocation.name_location',
		'idJob.name_job',
		'id_category',
		//'id_video',
		//'video_thumbnail',
		//'amount_label',
	),
)); ?>


