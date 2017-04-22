<div class="container" id="main-page">
	<div class="row">
		<div class="col-sm-6">
			<div class="clearfix">
				<?php $this->load->view("home/slider");?>
			</div>
		</div>
		<div class="col-sm-6">
			<?php $this->load->view("home/supershortcutbutton");?>
		</div>
	</div>
</div>
<section class="block-light">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul id="itemTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">What's New</a></li>
					<li role="presentation" class=""><a href="#item-most-wanted" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Most Wanted</a></li>
				</ul>
				<div id="itemTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
						<div class="row">
							<?php 
								$listgood = $this->datagood->getNewList(12);
								foreach($listgood as $key=>$val){
									?>
									<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 highlight">
										<div class="row">
											<div class="col-xs-4 col-sm-6">
												<a href="<?php print base_url();?>good/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php 
													if($this->datagood->getTotalPhoto($val->id_post)>0){
														$photoURL = $this->datagood->getOneURLPhoto($val->id_post);
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
											<div class="col-xs-8 col-sm-6 mini-details">
												<a href="<?php print base_url();?>good/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php if(strlen($val->title)>20){?>
														<h5><?=substr($val->title,0,20);?>..</h5>
													<?php }else{?>
														<h5><?=$val->title?></h5>
													<?php }?>
												</a>
												<p class="price">
													<i class="fa fa-yen"></i> <?=number_format($val->amount,2)?>
												</p>
												<p class="text-muted">
													<small><?=date("Y-m-d",$val->post_time)?></small>
												</p>
											</div>
										</div>
									</div>
									<?php 
								}
							?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="item-most-wanted" aria-labelledby="profile-tab">
						<div class="row">
						<?php 
								$listgood = $this->datagood->getMostWanted(12);
								foreach($listgood as $key=>$val){
									?>
									<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 highlight">
										<div class="row">
											<div class="col-xs-4 col-sm-6">
												<a href="<?php print base_url();?>good/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php 
													if($this->datagood->getTotalPhoto($val->id_post)>0){
														$photoURL = $this->datagood->getOneURLPhoto($val->id_post);
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
											<div class="col-xs-8 col-sm-6 mini-details">
												<a href="<?php print base_url();?>good/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php if(strlen($val->title)>20){?>
														<h5><?=substr($val->title,0,20);?>..</h5>
													<?php }else{?>
														<h5><?=$val->title?></h5>
													<?php }?>
												</a>
												<p class="price">
													<i class="fa fa-yen"></i> <?=number_format($val->amount,2)?>
												</p>
												<p class="text-muted">
													<small><?=date("Y-m-d",$val->post_time)?></small>
												</p>
											</div>
										</div>
									</div>
									<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="block-light">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul id="jobTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#uregent_required" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Urgently required</a></li>
					<li role="presentation" class=""><a href="#job-most-wanted" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Most Wanted</a></li>
				</ul>
				<div id="jobTabContent" class="tab-content">
					<div role="tabpanel" class="tab-pane fade active in" id="uregent_required" aria-labelledby="home-tab">
						<div class="row">
							<?php 
								$listjob = $this->datajob->getNewList(6);
								foreach($listjob as $key=>$val){
									?>
									<div class="col-md-2 col-xs-6 highlight">
										<div class="row">
											<div class="col-xs-12 mini-details">
												<a href="<?php print base_url();?>job/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php if(strlen($val->title)>20){?>
														<h5><?=substr($val->title,0,20);?>..</h5>
													<?php }else{?>
														<h5><?=$val->title?></h5>
													<?php }?>
												</a>
												<p class="salary">
													<i class="fa fa-yen"></i> <?=number_format($val->amount,2)?>
												</p>
												<p class="text-muted">
													<small><?=date("Y-m-d",$val->post_time)?></small>
												</p>
											</div>
										</div>
									</div>
									<?php 
								}
							?>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="job-most-wanted" aria-labelledby="profile-tab">
						<div class="row">
							<?php 
								$listjob = $this->datajob->getMostWanted(6);
								foreach($listjob as $key=>$val){
									?>
									<div class="col-md-2 col-xs-6 highlight">
										<div class="row">
											<div class="col-xs-12 mini-details">
												<a href="<?php print base_url();?>job/post/<?=$val->url_post;?>" title="<?=$val->title;?>">
													<?php if(strlen($val->title)>20){?>
														<h5><?=substr($val->title,0,20);?>..</h5>
													<?php }else{?>
														<h5><?=$val->title?></h5>
													<?php }?>
												</a>
												<p class="salary">
													<i class="fa fa-yen"></i> <?=number_format($val->amount,2)?>
												</p>
												<p class="text-muted">
													<small><?=date("Y-m-d",$val->post_time)?></small>
												</p>
											</div>
										</div>
									</div>
									<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view("home/hotthreadnevent");?>
<section class="block-semi-grey">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="block-white">
					<h3><i class="ion-ios-location mediumsize"></i>Hot Locations</h3>
					<?php 
						$locations = $this->datalocation->getHotLocation(0,18);
						foreach($locations as $key=>$val){
							?>
							<a href="<?=base_url();?>good?keyword=&id_location=<?=$val->id_location?>&id_category=" class="city-tag"><?=$val->name_location?></a>
							<?php
						}
					?>
				</div>
			</div>
			
			<div class="col-sm-8">
				<div class="block-white">
					<h3><i class="ion-android-cart mediumsize"></i>Hot Categories</h3>
					<div class="row clearfix">
						<div class="col-sm-3 col-xs-6">
							<ul class="category-list">
								<?php
									$hotcat = $this->dataitem->getHotItem(0,6);
									foreach($hotcat as $key=>$val){
										?>
										<li><a href="<?=base_url();?>good?keyword=&id_location=&id_category=<?=$val->id_item;?>"><i class="ion-record blue"></i> <?=$val->name_item?></a></li>
										<?php 
									}
								?>
							</ul>
						</div>
						<div class="col-sm-3 col-xs-6">
							<ul class="category-list">
								<?php
									$hotcat = $this->dataitem->getHotItem(6,6);
									foreach($hotcat as $key=>$val){
										?>
										<li><a href="<?=base_url();?>good?keyword=&id_location=&id_category=<?=$val->id_item;?>"><i class="ion-record blue"></i> <?=$val->name_item?></a></li>
										<?php 
									}
								?>
							</ul>
						</div>
						<div class="col-sm-3 col-xs-6">
							<ul class="category-list">
								<?php
									$hotcat = $this->dataitem->getHotItem(12,6);
									foreach($hotcat as $key=>$val){
										?>
										<li><a href="<?=base_url();?>good?keyword=&id_location=&id_category=<?=$val->id_item;?>"><i class="ion-record blue"></i> <?=$val->name_item?></a></li>
										<?php 
									}
								?>
							</ul>
						</div>
						<div class="col-sm-3 col-xs-6">
							<ul class="category-list">
								<?php
									$hotcat = $this->dataitem->getHotItem(18,6);
									foreach($hotcat as $key=>$val){
										?>
										<li><a href="<?=base_url();?>good?keyword=&id_location=&id_category=<?=$val->id_item;?>"><i class="ion-record blue"></i> <?=$val->name_item?></a></li>
										<?php 
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--
<section id="block-semi-hot">
	<div class="container">
		<div class="col-sm-12">
			<div class="block-white">
				<h3><i class="ion-fireball mediumsize"></i>What are HOTtest?</h3>
				<div class="col-sm-3" id="block-hot-reward">
					<h4>Get Rewards for your posts</h4>
					
				</div>
				<div class="col-sm-3" id="block-hot-promote">
					<h4>Promote your Items Instantly</h4>
					<ul id="promotTab" class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#promote-daily" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Daily</a></li>
						<li role="presentation" class=""><a href="#promote-anually" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Anually</a></li>
					</ul>
					<div id="promoTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="promote-daily" aria-labelledby="home-tab">
							<div class="row">
								<div class="col-md-12 text-center">
									<p>
										If you promote your account Anually, you will 
										save 30% of your daily budget
									</p>
									<a href="" class="btn btn-orange">START NOW</a>
								</div>
							</div>
						</div>
						
						<div role="tabpanel" class="tab-pane fade in" id="promote-anually" aria-labelledby="home-tab">
							<div class="row">
								<div class="col-md-12 text-center">
									<p>
										If you promote your account Anually, you will 
										save 30% of your daily budget
									</p>
									<a href="" class="btn btn-blue">START NOW</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3" id="block-hot-auction">
					<h4>ichibanlist.com Auctions</h4>
					<div class="row clearfix">
						<div class="col-xs-3">
							<img src="<?php //print base_url();?>assets/img/post/auction1.png">
						</div>
						<div class="col-xs-2 white-price">
							<span>152.23</span><br>
							<span>USD</span>
						</div>
						<div class="col-xs-6 text-center">
							<span class="remaining">15:12:11</span>
							<span class="white">remaining</span>
						</div>
					</div>
					<hr>
					<div class="row clearfix">
						<div class="col-xs-3">
							<img src="<?php //print base_url();?>assets/img/post/auction1.png">
						</div>
						<div class="col-xs-2 white-price">
							<span>152.23</span><br>
							<span>USD</span>
						</div>
						<div class="col-xs-6 text-center">
							<span class="remaining">15:12:11</span>
							<span class="white">remaining</span>
						</div>
					</div>
				</div>
				<div class="col-sm-3" id="block-hot-online-cv">
					<h4>Get your CV Online Here</h4>
					<div class="row clearfix">
						<div class="col-sm-12" style="margin-bottom:20px;">
							<a href="" class="btn btn-white-blue">UPLOAD NOW</a>
						</div>
					</div>
					<div class="row clearfix">
						<div class="col-xs-4">
							<img src="<?php //print base_url();?>assets/img/upload/photo_default.png" class="img-polaroid img-fetch">
						</div>
						<div class="col-xs-8 white">
							Hi, i am a web programmer.
							I just created my CV online
							and 3 companies called... 
						</div>
						<div class="col-xs-12 white">
							<strong>pwiguna</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
-->