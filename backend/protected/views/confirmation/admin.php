<?php
/* @var $this ConfirmationController */
/* @var $model Confirmation */

$this->breadcrumbs=array(
	'Confirmations'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#confirmation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Confirmations</h1>

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
	'id'=>'confirmation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_confirmation',
		'idUser.first_name',
		'idUser.last_name',
		'idPost.title',
		'idBank.name_bank',
		'amount',
			  array('name'=>'file_confirm',
                          'type'=>'html',
                          'header'=>'file_confirm',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>'CHtml::image("'.Yii::app()->request->baseUrl.'/../$data->file_confirm","",array("style"=>"width:100px;"))',
                        ),
		//'note',
		/*
		'file_confirm',
		'created_at',
		*/
		// array(
		// 	'class'=>'CButtonColumn',
		// ),
	),
)); ?>
