<?php 
	$limit = 24;
	switch($this->router->fetch_class()){
		case "good":
			$search['keyword'] 		= @$_GET['keyword'];
			$keyword 				= explode(" ",$search['keyword']);
			$search['keyword']		= $keyword;
			$search['id_location']	= @$_GET['id_location'];
			$search['id_category']	= @$_GET['id_category'];
			
			$this->dataitem->plusOneViewer($search['id_category']);
			$this->datalocation->plusOneViewer($search['id_location']);
			
			$lists = $this->datagood->getListOfdata(@$_GET['page'],$limit,0,$search);
			$total = $this->datagood->getListOfdataNoLimit($search);
			$modeldata = "datagood";
		break;
		
		case "job":
			$search['keyword'] 		= @$_GET['keyword'];
			$keyword 				= explode(" ",$search['keyword']);
			$search['keyword']		= $keyword;
			$search['id_location']	= @$_GET['id_location'];
			$search['id_category']	= @$_GET['id_category'];
			
			$this->datacategory->plusOneViewer($search['id_category']);
			$this->datalocation->plusOneViewer($search['id_location']);
			
			$lists = $this->datajob->getListOfdata(@$_GET['page'],$limit,0,$search);
			$total = $this->datajob->getListOfdataNoLimit($search);
			$modeldata = "datajob";
		break;
		
		case "forum":
			$search['keyword'] 		= @$_GET['keyword'];
			$keyword 				= explode(" ",$search['keyword']);
			$search['keyword']		= $keyword;
			$search['id_location']	= @$_GET['id_location'];
			$search['id_category']	= @$_GET['id_category'];
			
			// $this->datacategory->plusOneViewer($search['id_category']);
			// $this->datalocation->plusOneViewer($search['id_location']);
			
			$lists = $this->dataforum->getListOfdata(@$_GET['page'],$limit,0,$search);
			$total = $this->dataforum->getListOfdataNoLimit($search);
			$modeldata = "dataforum";
		break;

                case "auction":
			$search['keyword'] 		= @$_GET['keyword'];
			$keyword 				= explode(" ",$search['keyword']);
			$search['keyword']		= $keyword;
			$search['id_location']	= @$_GET['id_location'];
			$search['id_category']	= @$_GET['id_category'];
			
			$this->datacategory->plusOneViewer($search['id_category']);
			$this->datalocation->plusOneViewer($search['id_location']);
			
			$lists = $this->dataauction->getListOfdata(@$_GET['page'],$limit,0,$search);
			$total = $this->dataauction->getListOfdataNoLimit($search);
			$modeldata = "dataauction";
		break;
	}
?>
<div class="search-result-head">
	<?php if(@$_GET['keyword']!=""){ ?>
		<strong><?=number_format($total);?> posts </strong> found for keywords <strong>'<?=@$_GET['keyword']?>'</strong>
		
		<?php if($search['id_category']!=""){?>
			, on <strong>'<?=$this->$modeldata->getCategoryName($search['id_category']);?>'</strong>
		<?php } ?>
		
		<?php if($search['id_location']!=""){?>
			, at <strong>'<?=$this->$modeldata->getLocation($search['id_location']);?>'</strong>
		<?php } ?>
	<?php }else{ ?>
		<strong><?=number_format($total);?> posts </strong> found
	<?php } ?>
</div>
<div class="search-result-body clearfix">
	<div class="clearfix row-result">
	<?php 
		$cardinal = 0;
		if(count($lists)>0){
			foreach($lists as $key=>$val){
				?>
					<div class="col-sm-6 col-md-3 highlight"> 
						<div class="row">
							<div class="col-xs-5" style="height:">
								<a href="<?php print base_url();?><?php print $this->router->fetch_class();?>/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
									<?php 
									if($this->$modeldata->getTotalPhoto($val->id_post)>0){
										$photoURL = $this->$modeldata->getOneURLPhoto($val->id_post);
										if($photoURL->thumbnail_path!=""){
											?><img src="<?php print base_url();?><?php print $photoURL->thumbnail_path;?>" style="max-width:100%;max-height:100px;overflow:hidden;padding-bottom:10px;"><?php
										}else{
											?><img src="<?php print base_url();?>assets/img/no-photo.png" style="max-width:100%;max-height:100px;overflow:hidden;padding-bottom:10px;"><?php
										}
									}else{
										?><img src="<?php print base_url();?>assets/img/no-photo.png" style="max-width:100%;max-height:100px;overflow:hidden;padding-bottom:10px;"><?php
									}?>
								</a>
							</div>
							<div class="col-xs-7 mini-details">
								<?php 
									if($this->router->fetch_class()!="forum"){
										$limittext = 20;
									}else{
										$limittext = 45;
									}
								?>
								<a href="<?php print base_url();?><?php print $this->router->fetch_class();?>/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
									<?php if(strlen($val->title)>$limittext){?>
										<h5><?=substr($val->title,0,$limittext);?>..</h5>
									<?php }else{?>
										<h5><?=$val->title?></h5>
									<?php }?>
								</a>
								<?php if($this->router->fetch_class()!="forum"){?>
								<p class="price">
									<i class="fa fa-yen"></i> <?=number_format($val->amount);?>
								</p>
								<?php } ?>
								<p class="text-muted">
									<small><?=date("Y-m-d",$val->post_time);?></small>
								</p>
							</div>
						</div>
					</div>
				<?php
				$cardinal++;
				if($cardinal==4){
					?>
					</div>
					<div class="clearfix row-result">
					<?php 
					$cardinal = 0;
				}
			}
		}else{
			?><p class="alert alert-danger">Data not found!</p><?php
		}
						
	?>
	</div>
</div>
<?php 
	if(@$_GET['keyword']!=""){
		$this->pagination->showPagging($total,"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],"center",@$_GET['page'],$limit,2);
	}else{
		$this->pagination->showPagging($total,"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],"center",@$_GET['page'],$limit,1);
	}
?>