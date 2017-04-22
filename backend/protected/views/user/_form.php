<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,		 
	'htmlOptions' => array(
    'enctype' => 'multipart/form-data',
    ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'value'=>"")); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'repeat_password'); ?>
		<?php echo $form->passwordField($model,'repeat_password',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'repeat_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birth_date'); ?>
		     <?php
		     $thn = date("Y");
                $tanggal = date('Y-m-d');  
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'birth_date',
                       'options' => array(
                        'dateFormat'=> 'yy-mm-dd',
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange'=>'1945:$thn',
                    ),
                 
                    'htmlOptions' => array('value' => date("Y-m-d",$model->birth_date)),
                ));
                ?>
		<?php echo $form->error($model,'birth_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'about_me'); ?>
		<?php echo $form->textArea($model,'about_me',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'about_me'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook_id'); ?>
		<?php echo $form->textField($model,'facebook_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'facebook_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'social_type'); ?>
		<?php
		 echo $form->radioButtonList($model, 'social_type',
							                    array(  'none' => 'none',
							                            'facebook' => 'facebook',
							                            'twitter' => 'twitter',),
		                  array(
		    'labelOptions'=>array('style'=>'display:inline'), // add this code
		    'separator'=>'  ',
		) );
		?>
		<?php echo $form->error($model,'social_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php
		 echo $form->radioButtonList($model, 'level',
							                    array(  'user' => 'user',
							                            'admin' => 'admin',),
		                  array(
		    'labelOptions'=>array('style'=>'display:inline'), // add this code
		    'separator'=>'  ',
		) );
		?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter_id'); ?>
		<?php echo $form->textField($model,'twitter_id',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'twitter_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'instagram_id'); ?>
		<?php echo $form->textField($model,'instagram_id',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'instagram_id'); ?>
	</div>

	<div class="row" >
                <?php echo $form->labelEx($model, 'idLocation.name_location'); ?>
                <?php // echo $form->textField($model,'id_usaha',array('size'=>10,'maxlength'=>10));  ?>
                <?php
                $this->widget('ext.select2.ESelect2', array(
                    'model' => $model,
                    'attribute' => 'id_location',
                    'data' => $model->getLocation(),
                    'htmlOptions' => array('selected'=>'selected','reqiured'=>'required','style'=>'width:30%;'),
                ));
                ?>
                <?php echo $form->error($model, 'id_location'); ?> 
            </div> 

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php if($this->action->id=="update"){
			echo CHtml::image(Yii::app()->request->baseUrl.'/../'.$model->avatar,"gambar",array("width"=>100));
			}   ?>

		<?php echo $form->fileField($model,'avatar',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'alert_me',array('value'=>'yes')); ?>
		<?php echo $form->label($model,'alert_me'); ?>
		<?php echo $form->error($model,'alert_me'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->