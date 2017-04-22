div class="row">
		<?php echo $form->labelEx($model,'time_open'); ?>
		<?php $this->widget ('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
                array(
                    'model'=>$model, //Model object
                    'attribute'=>'time_open', //attribute name
                    'mode'=>'datetime', //use "time","date" or "datetime" (default)
                    'language'=>'',
                    'options'=>array(
                            'regional'=>'',
                            'dateFormat'=> 'yy-mm-dd',
                            'changeYear'=>true,
                        ) // jquery plugin options
            ));
        ?>
		<?php echo $form->error($model,'time_open'); ?>
	</div>

	<div class="row">
		<?php //  echo $form->labelEx($model,'time_close'); ?>
			<?php  $this->widget ('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker',
                    array(
                    'model'=>$model, //Model object
                    'attribute'=>'time_close', //attribute name
                    'mode'=>'datetime', //use "time","date" or "datetime" (default)
                    'language'=>'',
                    'options'=>array(
                            'regional'=>'',
                            'dateFormat'=> 'yy-mm-dd',
                            'changeYear'=>true,
                        ) // jquery plugin options
                    ));
        ?>
		<?php echo $form->error($model,'time_close'); ?>
	</div>

        <div class="row">
        <?php echo $form->labelEx($model,'amount_label'); ?>
        <?php echo $form->textField($model,'amount_label',array('size'=>60,'maxlength'=>64)); ?>
        <?php echo $form->error($model,'amount_label'); ?>
    </div>

    
            $model->time_open = strtotime($_POST['Post']['time_open']);
            $model->time_close = strtotime($_POST['Post']['time_close']);