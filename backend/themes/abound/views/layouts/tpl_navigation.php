<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="#"><?php echo CHtml::encode($this->pageTitle); ?></a>
          
          <div class="nav-collapse">
		      <?php $this->widget('zii.widgets.CMenu',array(
                 'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
                    'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'User', 'url'=>array('/User/admin')),
                array('label'=>'Location', 'url'=>array('/Location/admin')),
                array('label'=>'Item Category', 'url'=>array('/Item/admin')),
                array('label'=>'Job Category', 'url'=>array('/Job/admin')),
                array('label'=>'Thread Category ', 'url'=>array('/Thread/admin')),
                    array('label'=>'Post', 'url'=>array('#'),'itemOptions'=>array(
                                                'class'=>'dropdown-submenu',
                                                ),
                'items'=>array(
                array('label'=>'Items ', 'url'=>array('/Post/items')),
                array('label'=>'Jobs ', 'url'=>array('/Post/jobs')),
                array('label'=>'Threads ', 'url'=>array('/Post/threads')),
                array('label'=>'Auction ', 'url'=>array('/Post/auctions')),
                  )),



              
                array('label'=>'Banks ', 'url'=>array('/Bank/admin')),
                array('label'=>'Confirmations ', 'url'=>array('/Confirmation/admin')),
                array('label'=>'LOGIN', 'url'=>array('/site/login/index'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'LOGOUT ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                // array('label'=>'Data Produksi', 'url'=>array('/produksi/admin')),
                // array('label'=>'Grafik', 'url'=>array('/produksi/grafik')) 
                ),
        )); ?>
    	</div>
    </div>
	</div>
</div>

<!-- <div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav --> -->