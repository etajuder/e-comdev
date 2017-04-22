<?php
	switch($this->router->fetch_class()){
		case "good":
			$user 	= $this->session->userdata("user");
			$sesi 	= $this->datagood->getDetailByURL($this->uri->segment(3));
			$city 	= $sesi->id_location;
			$bank  = $this->datagood->getDetailBank($sesi->author);
			$category = $sesi->id_category;		//id_item
			//==== counter ===
			$found = "NO";
			$sesicounter = $this->session->userdata("url_counter");
			$current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(is_array(@$sesicounter)){
				foreach(@$sesicounter as $key=>$val){
					if($current_url == $val['url']){
						$found = "YES";
						break;
					}
				}
				if($found=="NO"){
					$counter = array(
						"url" => $current_url
					);
					$sesicounter[] = $counter;
					$this->session->set_userdata("url_counter",$sesicounter);
					//=== COUNTER ==
					$this->dataitem->plusOneViewer($category);
					$this->datalocation->plusOneViewer($city);
					$this->datagood->plusOneViewer($sesi->id_post);
					//==============
				}
			}else{
				$counter = array(
					"url" => $current_url
				);
				$sesicounter[] = $counter;
				$this->session->set_userdata("url_counter",$sesicounter);
				//=== COUNTER ==
				$this->dataitem->plusOneViewer($category);
				$this->datalocation->plusOneViewer($city);
				$this->datagood->plusOneViewer($sesi->id_post);
				//==============
			}
			//================
			$photos = $this->datagood->getListPhotoOfPost($sesi->id_post);
			$modeldata = "datagood";
		break;
		
		case "job":
			$user 	= $this->session->userdata("user");
			$sesi 	= $this->datajob->getDetailByURL($this->uri->segment(3));
			$city 	= $sesi->id_location;
			$category = $sesi->id_category;		//id_job
			//==== counter ===
			$found = "NO";
			$sesicounter = $this->session->userdata("url_counter");
			$current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(is_array(@$sesicounter)){
				foreach(@$sesicounter as $key=>$val){
					if($current_url == $val['url']){
						$found = "YES";
						break;
					}
				}
				if($found=="NO"){
					$counter = array(
						"url" => $current_url
					);
					$sesicounter[] = $counter;
					$this->session->set_userdata("url_counter",$sesicounter);
					//=== COUNTER ==
					$this->datacategory->plusOneViewer($category);
					$this->datalocation->plusOneViewer($city);
					$this->datajob->plusOneViewer($sesi->id_post);
					//==============
				}
			}else{
				$counter = array(
					"url" => $current_url
				);
				$sesicounter[] = $counter;
				$this->session->set_userdata("url_counter",$sesicounter);
				//=== COUNTER ==
				$this->datacategory->plusOneViewer($category);
				$this->datalocation->plusOneViewer($city);
				$this->datajob->plusOneViewer($sesi->id_post);
				//==============
			}
			//================
			$photos = $this->datajob->getListPhotoOfPost($sesi->id_post);
			$modeldata = "datajob";
		break;
		
		case "forum":
			$user 	= $this->session->userdata("user");
			$sesi 	= $this->dataforum->getDetailByURL($this->uri->segment(3));
			$category = $sesi->id_category;		//id_thread
			//==== counter ===
			$found = "NO";
			$sesicounter = $this->session->userdata("url_counter");
			$current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(is_array(@$sesicounter)){
				foreach(@$sesicounter as $key=>$val){
					if($current_url == $val['url']){
						$found = "YES";
						break;
					}
				}
				if($found=="NO"){
					$counter = array(
						"url" => $current_url
					);
					$sesicounter[] = $counter;
					$this->session->set_userdata("url_counter",$sesicounter);
					//=== COUNTER ==
					// $this->datacategory->plusOneViewer($category);
					// $this->datalocation->plusOneViewer($city);
					$this->dataforum->plusOneViewer($sesi->id_post);
					//==============
				}
			}else{
				$counter = array(
					"url" => $current_url
				);
				$sesicounter[] = $counter;
				$this->session->set_userdata("url_counter",$sesicounter);
				//=== COUNTER ==
				// $this->datacategory->plusOneViewer($category);
				// $this->datalocation->plusOneViewer($city);
				$this->dataforum->plusOneViewer($sesi->id_post);
				//==============
			}
			//================
			$photos = $this->dataforum->getListPhotoOfPost($sesi->id_post);
			$modeldata = "dataforum";
		break;

                case "auction":
			$user 	= $this->session->userdata("user");
			$sesi 	= $this->dataauction->getDetailByURL($this->uri->segment(3));
			$city 	= $sesi->id_location;
			$category = $sesi->id_category;		//id_item
			//==== counter ===
			$found = "NO";
			$sesicounter = $this->session->userdata("url_counter");
			$current_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if(is_array(@$sesicounter)){
				foreach(@$sesicounter as $key=>$val){
					if($current_url == $val['url']){
						$found = "YES";
						break;
					}
				}
				if($found=="NO"){
					$counter = array(
						"url" => $current_url
					);
					$sesicounter[] = $counter;
					$this->session->set_userdata("url_counter",$sesicounter);
					//=== COUNTER ==
					$this->dataitem->plusOneViewer($category);
					$this->datalocation->plusOneViewer($city);
					$this->dataauction->plusOneViewer($sesi->id_post);
					//==============
				}
			}else{
				$counter = array(
					"url" => $current_url
				);
				$sesicounter[] = $counter;
				$this->session->set_userdata("url_counter",$sesicounter);
				//=== COUNTER ==
				$this->dataitem->plusOneViewer($category);
				$this->datalocation->plusOneViewer($city);
				$this->dataauction->plusOneViewer($sesi->id_post);
				//==============
			}
			//================
			$photos = $this->dataauction->getListPhotoOfPost($sesi->id_post);
			$modeldata = "dataauction";
		break;
	}
?>
<div class="search-result-head">
	<?php if($this->session->userdata("global_search")!=""){ ?>
		<strong><?//=number_format(count($lists));?> posts </strong> found for keywords <strong>'<?php print $this->session->userdata("global_search");?>'</strong> in <strong>‘Hokaido’</strong>
	<?php }else{ ?>
		<strong><?//=number_format(count($lists));?> posts </strong> found
	<?php } ?>
</div>

<div class="row" style="margin-top:15px;">
	<div class="col-sm-4">
		<?php 
			$photouploaded = 0;
			if(count($photos)>0){
				foreach($photos as $key=>$val){
					?><img src="<?php print base_url();?><?php print $val->path;?>"  data-zoom-image="<?php print base_url();?><?php print $val->path;?>" style="width:100%;padding-bottom:20px;" id="zoom_01"><?php
					break;
				}
			}
		?>
		<div class="row" style="margin-bottom:20px;">
			<div class="col-sm-12">
				<a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=http://<?php print $_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];?>&pubid=ra-5342810a202a20bb&ct=1&title=<?php print $sesi->title;?>&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/facebook.png" border="0" alt="Facebook"/></a>
				<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=http://<?php print $_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];?>&pubid=ra-5342810a202a20bb&ct=1&title=<?php print $sesi->title;?>&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/twitter.png" border="0" alt="Twitter"/></a>
				<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url=http://<?php print $_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];?>&pubid=ra-5342810a202a20bb&ct=1&title=<?php print $sesi->title;?>&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/google_plusone_share.png" border="0" alt="Google+"/></a>
				<a href="https://api.addthis.com/oexchange/0.8/forward/blogger/offer?url=http://<?php print $_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];?>&pubid=ra-5342810a202a20bb&ct=1&title=<?php print $sesi->title;?>&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/blogger.png" border="0" alt="Blogger"/></a>
				<a href="https://www.addthis.com/bookmark.php?source=tbx32nj-1.0&v=300&url=http://<?php print $_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];?>&pubid=ra-5342810a202a20bb&ct=1&title=<?php print $sesi->title;?>&pco=tbxnj-1.0" target="_blank"><img src="https://cache.addthiscdn.com/icons/v2/thumbs/32x32/addthis.png" border="0" alt="Addthis"/></a>
			</div>
		</div>
		<div class="row" id="related-big">
			<div class="col-sm-12" style="margin-bottom:15px;">
				<h4>Related Posts</h4>
			</div>
			<div class="col-sm-12">
			<?php 
				$related = $this->$modeldata->getRelatedPost($sesi->id_category,$sesi->post_type);
				foreach($related as $key=>$val){
					?>
						<div class="row">
							<div class="col-xs-3" style="height:">
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
							<div class="col-xs-9">
								<a href="<?php print base_url();?><?php print $this->router->fetch_class();?>/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
									<h5 style="font-weight:700;"><?=$val->title?></h5>
								</a>
								<?php if($this->router->fetch_class()!="forum"){?>
								<p class="price">
									<i class="fa fa-yen"></i> <?=number_format($val->amount);?>
								</p>
								<?php } ?>
							</div>
						</div>
					<?php
				}
			?>
			</div>
		</div>
	</div>
	<div class="col-sm-8">
		<h1><?=$sesi->title;?></h1>
		<hr>
		<table class="table-no-class">
			<?php
				switch($this->router->fetch_class()){
					case "good": ?>
						<tr><td><strong>Price</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount)?></td></tr>
						<?php 
					break;
case "auction": ?>
				
				
		
				

						<tr><td><strong>Lowest Price</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount)?></td></tr>
						<tr><td><strong>Amount Bid</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount_bid)?></td></tr>
						<tr><td><strong>Bid Time</strong></td><td><i class="fa fa-clock"></i> 	<div class="row">
				<div class="countdown">
					<div id="jcountdown"></div>
				</div> </td></tr>
						<script type="text/javascript">
  $("#jcountdown")
  .countdown("<?=date('Y/m/d',$sesi->time_close)?>", function(event) {
    $(this).html(
      event.strftime(''
      + '<span>%D</span> days '
      + '<span>%H</span> hr '
      + '<span>%M</span> min '
      + '<span>%S</span> sec')
    );
  });
</script>
<style type="text/css">
	.countdown {
		position: relative; 
		color: lightblue; 
		font-size: 12px; 
		font-family:arial; 
		display: block; 
		width: auto; 
		margin: auto; 
		text-align: center; 
		background:rgba(0,0,0,0.7);  padding:10px;
		 }
#jcountdown > span {font-size:16px; margin-left:10px; color:white;}
</style>
						<?php 
					break;
					case "job":
						?>
						<tr><td><strong>Salary (<?=$val->amount_label;?>)</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount,2)?></td></tr>
						<tr><td><strong>Open Recruitment</strong></td><td><i class="fa fa-calendar"></i> <?=date("Y-m-d",$sesi->time_open)." - <i class='fa fa-calendar'></i> ".date("Y-m-d",$sesi->time_close)?></td></tr>
						<?php 
					break;
					
				} ?>
			<tr><td><strong>Author</strong></td><td><a href="<?=base_url();?>user/profile/<?=$sesi->author;?>"><strong><?=$this->datauser->getAuthorName($sesi->author);?></strong></a> <a class="btn btn-default" href="<?=base_url();?>user/createMessage/<?=$sesi->author;?>" title="Send message"><i class="fa fa-envelope-o"></i> </a></td></tr>
			<tr><td><strong>Date Posted</strong></td><td><?=date("Y-m-d H:i:s",$sesi->post_time);?></td></tr>
			<?php if($this->router->fetch_class()!="forum"){?>
			<tr><td><strong>Location</strong></td><td><?=$this->$modeldata->getLocation($sesi->id_location);?></td></tr>
			<?php } ?>
		</table>
		<div id="content-post">
			<div class="row">
				<?php 
					if(count($photos)>0){
						foreach($photos as $key=>$val){
							?>
							<div class="col-xs-4 col-sm-2 text-center" id="<?=$val->id_photo;?>_photo" style="margin-bottom:15px;">
								<img src="<?=base_url()?><?=$val->path;?>" class="preview-thumb">
							</div>
							<?php
						}
					}
				?>							
			</div>
				<script type="text/javascript">
				$(document).ready(function(){
					$(".bank-thumb").on('click',function(){
						if($(this).next( "div").hasClass('open')){
						$(".detail-bank").removeClass("open");	
						}else{
						$(".detail-bank").removeClass("open");
						$(this).next( "div").addClass('open');	
						}
						
					});
				});
			</script>
			<?=$sesi->content?>


			<?php if(is_array($this->session->userdata("user"))){ ?>
			<?php
				$bid = $this->databid->maxBid($sesi->id_post);
				switch($this->router->fetch_class()){
					case "auction": ?>
						<div id="bid">
							<button class="btn btn-orange" data-toggle="modal" data-target="#myModal">Bid Now</button> <?php if($bid->max_bid){?> Highest Bid: <i class="fa fa-yen"></i> <?=number_format($bid->max_bid); } ?> 
						</div>
						<?php 
					break;
					
				} ?>
			<?php } ?>

			<hr>
			<?php  if ( $this->router->fetch_class()=="good") {
				if (count($bank) > 1) {
			
				?>
		
			<div class="row">
				<u><h4>Ichibanlist Transfer</h4></u>
					<h5>JP-Post : リスキー　/ 17490 - 95196421</h5>
					<h5>BCA : Risky　/ 8410241499</h5>
				<u><h4>Direct Transfer</h4></u>
				<?php foreach ($bank as $key) {
				?>
				<div class="col-xs-4 col-sm-2 text-center" id="<?=$key->id_bank;?>_photo" style="margin-bottom:15px;">
								<img src="<?=base_url()?><?=$key->image_bank;?>" class="bank-thumb preview-thumb" style="cursor:pointer;">
				<div class="detail-bank">
					<ul>
						<li><label class="warning"> Account Name </label>  <?=$key->name_account;?></li>
						<li> <label class="warning">  Bank Number </label>  <?=$key->number_bank;?></li>
					</ul>
				</div>
				</div>
				<?php
				}
				}
				?>
			</div>
			<?php } ?>
			<div style="height:20px" class="clearfix"></div>
			<?php if(is_array($this->session->userdata("user"))){ ?>
			<form method="POST" action="<?=base_url();?><?=$this->router->fetch_class();?>/postComment" id="contact_form">
				<div class="row form-group">
					<div class="col-sm-12">
						<input type="hidden" name="id_post" value="<?=$sesi->id_post;?>">
						<textarea name="message" placeholder="Your Comment" rows="4" required="" class="form-control" id="v_pesan"></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-12">
						<button type="submit" name="submitContact" class="btn btn-blue" id="submitBtn">Submit comment</button>
					</div>
				</div>
			</form>
			<?php }else{ ?>
			<p>
				<a href="<?=base_url();?>user/login" class="btn btn-default">Give a comment</a>
			</p>
			<?php } ?>
			<?php $comments = $this->$modeldata->getListComment($sesi->id_post); ?>
			<h4> <?=count($comments);?> Comments</h4>
			<?php 
				if(is_array($comments)){
					foreach($comments as $key=>$val){
						?>
						<div class="row" style="margin-bottom:15px;">
							<div class="col-xs-2">
								<?php 
									$avatar = $this->datauser->getUserAvatar($val->author);
									if($avatar!=""){
										?><img src="<?=base_url();?><?=$avatar;?>" style="max-width:100%;" class="img-thumbnail"><?php
									}else{
										?><img src="<?=base_url();?>assets/img/no-photo.png" style="max-width:100%;" class="img-thumbnail"><?php
									}
								?>
							</div>
							<div class="col-xs-10">
								<strong><?php print $this->datauser->getAuthorName($val->author);?></strong> <small class="text-muted">on <?=date("d M Y, H:i",$val->time_comment)?></small>
								<br>
								<?=$val->comment;?>
							</div>
						</div>
						<?php
					}
				}
			?>
		</div>
		<hr>
		<div class="row" id="related-small">
			<div class="col-sm-12" style="margin-bottom:15px;">
				<h4>Related Posts</h4>
			</div>
			<div class="col-sm-12">
			<?php 
				$related = $this->$modeldata->getRelatedPost($sesi->id_category,$sesi->post_type);
				foreach($related as $key=>$val){
					?>
						<div class="row">
							<div class="col-xs-3" style="height:">
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
							<div class="col-xs-9 mini-details">
								<a href="<?php print base_url();?><?php print $this->router->fetch_class();?>/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
									<h5 style="font-weight:700;"><?=$val->title?></h5>
								</a>
								<?php if($this->router->fetch_class()!="forum"){?>
								<p class="price">
									<i class="fa fa-yen"></i> <?=number_format($val->amount);?>
								</p>
								<?php } ?>
							</div>
						</div>
					<?php
				}
			?>
			</div>
		</div>
	</div>
</div>

<?php if(is_array($this->session->userdata("user"))){ ?>
<?php
	switch($this->router->fetch_class()){
		case "auction": ?>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header" style="background: #FF5500; border: 1px solid #FF5500; color: #fff;">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Bid Form</h4>
			      </div>
			      <form action="<?=base_url();?>auction/bidProcess" method="POST">
			      		<div class="modal-body">
			      			<div class="row form-group">
								<label class="col-sm-2">
									Amount
								</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="price_bid" id="password" required="" placeholder="">
									<input type="hidden" name="id_post" value="<?=$sesi->id_post; ?>">
									<input type="hidden" name="url_post" value="<?=$sesi->url_post; ?>">
								</div>
							</div>

							<div class="row form-group">
								<label class="col-sm-2">
									Note
								</label>
								<div class="col-sm-8">
									<textarea class="form-control" name="detail" placeholder="Note"></textarea>
								</div>
							</div>
			      		</div>
				    	<div class="modal-footer">
				    		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				    		<button type="submit" class="btn btn-orange">Bid !</button>
				    	</div>
			      </form>
			    </div>
			  </div>
			</div>
	<?php 
		break;
		
	} ?>
<?php } ?>