<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id_user,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id_user)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_user),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
	array('label'=>'Add Bank', 'url'=>array('/DetailBank/create/','id'=>$model->id_user)),
	array('label'=>'List Bank', 'url'=>array('/DetailBank/admin/','id'=>$model->id_user)),
);
?>

<h1><?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user',
		'username',
		'email',
		'password',
		'first_name',
		'last_name',
		'phone',
		array('name'=>'birth_date',
                          'type'=>'html',
                          'header'=>'birth_date',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>date("Y-m-d",$model->birth_date),
                        ),
		'about_me',
		'facebook_id',
		'social_type',
		'level',
		'twitter_id',
		'instagram_id',
		'id_location',
		'idLocation.name_location',
		 array('name'=>'avatar',
                          'type'=>'html',
                          'header'=>'Avatar',
                          'htmlOptions'=> array('style'=>'text-align:center;'),
                                'value'=>CHtml::image(Yii::app()->request->baseUrl.'/../'.$model->avatar,"",array("style"=>"width:100px;")),
                        ),
		'alert_me',
	),
)); ?>
