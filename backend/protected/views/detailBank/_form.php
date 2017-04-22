<?php
/* @var $this DetailBankController */
/* @var $model DetailBank */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detail-bank-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	    <div class="row" >
                <?php echo $form->labelEx($model, 'id_bank'); ?>
                <?php // echo $form->textField($model,'id_usaha',array('size'=>10,'maxlength'=>10));  ?>
                <?php
                $this->widget('ext.select2.ESelect2', array(
                    'model' => $model,
                    'attribute' => 'id_bank',
                    'data' => $model->getbank(),
                    'htmlOptions' => array('selected'=>'selected','reqiured'=>'required'),
                ));
                ?>
                <?php echo $form->error($model, 'id_bank'); ?> 
       </div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_account'); ?>
		<?php echo $form->textField($model,'name_account',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number_bank'); ?>
		<?php echo $form->textField($model,'number_bank',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'number_bank'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location_bank'); ?>
		<?php echo $form->textArea($model,'location_bank',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'location_bank'); ?>
	</div>

	    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php
         echo $form->radioButtonList($model, 'status',
                            array(  '1' => 'active',
                                    '0' => 'inactive',),
                          
                           array(
            'labelOptions'=>array('style'=>'display:inline'), // add this code
            'separator'=>'  ',
        ) );


        ?>

        <?php echo $form->error($model,'status'); ?>
    </div>
    <br> <br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->