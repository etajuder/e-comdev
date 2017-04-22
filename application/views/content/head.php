<div id="head-navbar">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="menu-nav-mobile">
		<div class="container">
			<div class="row">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="orange ion-navicon-round icon-20"></span>
						</button>
						<a id="logo" href="<?php print base_url();?>" class="navbar-brand">
							<img src="<?php print base_url();?>assets/img/logo.png">
						</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<p class="head-label"><?php print $this->lang->line('head_pronoun');?></p>
							</li>
							<li class='<?php if($this->router->fetch_class()=="good" &&$this->router->fetch_method()=="index") { echo "head-active"; } ?> master-option'><a href="<?=base_url()?>good"><?=$this->lang->line("head_super_menu_good");?></a></li>
							<li class="<?php if($this->router->fetch_class()=="job" &&$this->router->fetch_method()=="index") { echo "head-active"; } ?> master-option" ><a href="<?=base_url()?>job"><?=$this->lang->line("head_super_menu_job");?></a></li>
                                                        <li class="<?php if($this->router->fetch_class()=="auction" &&$this->router->fetch_method()=="index") { echo "head-active"; } ?> master-option" ><a href="<?=base_url()?>auction"><?=$this->lang->line("head_super_menu_auction");?></a></li>
						</ul>
						<form method="get" action="" class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="<?=$this->lang->line("head_super_menu_search_placeholder");?>">
							</div>
							<button type="submit" class="btn btn-orange"><?=$this->lang->line("head_super_menu_search_button");?></button>
						</form>
						<ul class="nav navbar-nav navbar-right" id="user-menu">
							<li role="presentation" class="dropdown language">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="true">
									<?=ucfirst($this->session->userdata("language"))?> <span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?=base_url()?>language/jp">Japan</a></li>
									<li><a href="<?=base_url()?>language/en">English</a></li>
									<li><a href="<?=base_url()?>language/id">Indonesian</a></li>
								</ul>
							</li>
							<?php if($this->session->userdata("user")){ ?>
								<?php $user = $this->session->userdata("user");?>
								<li>
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="true">
									Hi, <strong><?=$user["first_name"];?> <?=$user['last_name'];?></strong> <span class="caret"></span>
									</a>
									<ul class="dropdown-menu text-left" role="menu">
										<li><a href="<?=base_url()?>dashboard">Dashboard <i class="ion-ios-speedometer"></i></a></li>
										<li><a href="<?=base_url()?>notification">My Notifications <i class="fa fa-bell"></i></a></li>
										<li><a href="<?=base_url()?>user/profile">My Profile <i class="ion-android-person"></i></a></li>
										<li><a href="<?=base_url()?>good/lists">My Items <i class="ion-ios-list-outline"></i></a></li>
										<li><a href="<?=base_url()?>job/lists">My Job Posts <i class="ion-ios-paper-outline"></i></a></li>
                                                                                <li><a href="<?=base_url()?>auction/lists">My Auctions <i class="ion-ios-briefcase"></i></a></li>
										<li><a href="<?=base_url()?>forum/lists">My Forum Threads <i class="ion-ios-chatbubble"></i></a></li>
										<li><a href="<?=base_url()?>message">My Messages <i class="ion-android-mail"></i></a></li>
										<li><a href="<?=base_url()?>good/bank">My Bank <i class="ion-cash"></i></a></li>
										<li><a href="<?=base_url()?>good/confirm">Payment Confirmation <i class="ion-check"></i></a></li>
										<li><a href="<?=base_url()?>user/logout">Logout <i class="ion-log-out"></i></a></li>
									</ul>
								</li>
							<?php }else{ ?>
							<li class="<?php if($this->router->fetch_class()=="user" &&$this->router->fetch_method()=="register") { echo "head-active"; } ?> master-option register"><a href="<?=base_url()?>user/register"><?=$this->lang->line("head_super_menu_register");?></a></li>
							<li class="<?php if($this->router->fetch_class()=="user" &&$this->router->fetch_method()=="login") { echo "head-active"; } ?> master-option login"><a href="<?=base_url()?>user/login"><?=$this->lang->line("head_super_menu_login");?></a></li>
							<?php } ?>
						</ul>
						
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>
<div class="container">
	<div class="col-sm-12">
		<div id="head-seal"></div>
	</div>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86417214-1', 'auto');
  ga('send', 'pageview');

</script>
</div>
