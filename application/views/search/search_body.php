<div class="container" id="main-page">
	<div class="row">
		<div class="col-sm-3">
			<div class="clearfix">
				<?php $this->load->view("search/search_form.php");?>
			</div>
			
			<div class="clearfix mini-lost">
				<?php $this->load->view("search/hot_thread.php");?>
			</div>
			
			<div class="clearfix mini-lost">
				<?php $this->load->view("search/promote.php");?>
			</div>
			
			<div class="clearfix mini-lost">
				<?php $this->load->view("search/hot_location.php");?>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="clearfix">
				<?php $this->load->view("search/search_result.php");?>
			</div>
			
			<div class="clearfix mini-show">
				<?php $this->load->view("search/hot_thread.php");?>
			</div>
			
			<div class="clearfix mini-show">
				<?php $this->load->view("search/promote.php");?>
			</div>
			
			<div class="clearfix mini-show">
				<?php $this->load->view("search/hot_location.php");?>
			</div>
		</div>
	</div>
</div>