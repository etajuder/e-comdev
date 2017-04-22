<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

  <div class="row-fluid">
  <div class="span3">
    <div class="sidebar-nav">
        <br> <br>
      <?php  $this->widget('zii.widgets.CMenu', array(
      'encodeLabel'=>false,
      'items'=>array(
        // array('label'=>'<i class="icon icon-home"></i>  Dashboard <span class="label label-info pull-right">BETA</span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'')),
        // array('label'=>'<i class="icon icon-search"></i> About this theme <span class="label label-important pull-right">HOT</span>', 'url'=>'http://www.webapplicationthemes.com/abound-yii-framework-theme/'),
        // array('label'=>'<i class="icon icon-envelope"></i> Messages <span class="badge badge-success pull-right">12</span>', 'url'=>'#'),
        // // Include the operations menu
        array('label'=>'OPERATIONS','items'=>$this->menu),
      ),
      ));  ?>
    </div>
        <br> <br> <br>
    
    
    </div>
    <div class="span8">
     <br> <br>
    <?php if(isset($this->breadcrumbs)):?>
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
      'homeLink'=>CHtml::link('Dashboard'),
      'htmlOptions'=>array('class'=>'breadcrumb')
        )); ?><!-- breadcrumbs 
    <?php endif?>
    
    <!-- Include content pages -->
    <?php echo $content; ?>

  </div> 
  </div>


<?php $this->endContent(); ?>