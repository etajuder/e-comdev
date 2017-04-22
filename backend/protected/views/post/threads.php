<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Thread', 'url'=>array('createthread')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage jobs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->threads(),
	'filter'=>$model,
	'columns'=>array(
		'id_post',
		'url_post',
		'title',
		'tags',
		'content',
		'post_type',
		/*
		'post_time',
		'author',
		'post_status',
		'amount',
		'time_open',
		'time_close',
		'viewer',
		'post_update_time',
		'id_location',
		'id_category',
		'id_video',
		'video_thumbnail',
		'amount_label',
		*/
array('header'=>'Operations',
    'class'=>'CButtonColumn',
    'template'=>'{view}{update}{delete}',
    'updateButtonUrl'=>'Yii::app()->request->baseUrl."/Post/updatethread/".$data->id_post',
    ),
	),
)); ?>
