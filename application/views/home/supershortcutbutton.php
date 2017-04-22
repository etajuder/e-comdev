<div class="clearfix">
	<div class="col-xs-6" id="big-block-job" onclick="javascript:document.location='<?=base_url();?>job';">
		<h1 class="oversize"><i class="ion-network"></i></h1>
		<h1>FIND A JOB</h1>
	</div>
	<div class="col-xs-6" id="big-block-forum" onclick="javascript:document.location='<?=base_url();?>forum';">
		<h1 class="oversize"><i class="ion-chatboxes"></i></h1>
		<h1>FORUM</h1>
	</div>
</div>
<div class="clearfix">
	<div class="col-xs-6" id="big-block-shortcut" >
		<p>Looking for employees?</p>
			<?php if(is_array($this->session->userdata("user"))){?>
				<a class="btn btn-blue btn-lg" href="<?=base_url();?>job/add">POST A JOB</a>
			<?php }else{ ?>
				<a class="btn btn-blue btn-lg" href="<?=base_url();?>user/login">POST A JOB</a>
			<?php } ?>
		<p>Got something unused?</p>
			<?php if(is_array($this->session->userdata("user"))){?>
				<a href="<?=base_url();?>good/add" class="btn btn-orange btn-lg">SELL AN ITEM</a>
			<?php }else{ ?>
				<a href="<?=base_url();?>user/login" class="btn btn-orange btn-lg">SELL AN ITEM</a>
			<?php } ?>
	</div>
	<div class="col-xs-6" id="big-block-item" onclick="javascript:document.location='<?=base_url();?>good';">
		<h1 class="oversize"><i class="ion-android-cart"></i></h1>
		<h1>FIND AN ITEM</h1>
	</div>
</div>