<?php 
	$user = $this->session->userdata("user");
	$sesi 	= $this->dataauction->getDetail($_GET['id']);
	$photos = $this->dataauction->getListPhotoOfPost($sesi->id_post);
?>
<div class="container">
	<div class="col-sm-8">
		<h1><?=$sesi->title;?></h1>
		<hr>
		<table class="table-no-class">
			<tr><td><strong>Lowest Price</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount)?></td></tr>
			<tr><td><strong>Amount Bid</strong></td><td><i class="fa fa-yen"></i> <?=number_format($sesi->amount_bid)?></td></tr>
			<tr><td><strong>Date Posted</strong></td><td><?=date("Y-m-d H:i:s",$sesi->post_time);?></td></tr>
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
		</div>
	</div>
	<div class="col-sm-12">
		<h2><i class="fa fa-shopping-cart"></i> Bid History</h2>
		<hr>
		<table class="table table-striped">
			<thead>
				<tr>
					<!--<th>No.</th>-->
					<th>Username</th>
					<th>Email</th>
					<th>Bid Price</th>
					<th>Date</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$option = $this->databid->getListUser();
					foreach($option as $key=>$val){
						$name[$val->id_user] = $val->first_name." ".$val->last_name;
						$email[$val->id_user] = $val->email;
					}

					$limit = 15;
					$lists = $this->databid->getListOfdata(@$_GET['page'],$limit,$user['id_user'], $_GET['id']);
					$no    = @$_GET['page'];
					if($no==""){ $no = 0;}else{ $no = ($no-1)*$limit;}
					if(count($lists)>0){
						foreach($lists as $key=>$val){
							$no++;
							?>
							<tr>
								<td><?=$name[$val->id_user] ? $name[$val->id_user] : "";?></td>
								<td><?=$email[$val->id_user] ? $email[$val->id_user] : "";?></td>
								<td><span class="pull-left"><i class="fa fa-yen"></i></span><span class="pull-right"> <?=number_format($val->price_bid);?></span></td>
								<td class="text-center"><?=date("Y.m.d H:i:s",$val->create_at);?></td>
								<td class="text-center"><?=$val->state;?></td>
								<td class="text-center">
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>auction/bidAccept/?id=<?=$val->id_bid?>&id_post=<?=$val->id_post; ?>'; }" title="Accept" style="color:#05b50a;">
										 <i class="fa fa-check fa-lg"></i> 
									</a>
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>auction/bidReject/?id=<?=$val->id_bid?>&id_post=<?=$val->id_post; ?>'; }" title="Reject" class="red">
										 <i class="fa fa-times fa-lg"></i> 
									</a>
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>auction/deleteBid/?id=<?=$val->id_bid?>&id_post=<?=$val->id_post; ?>'; }" class="red">
										 <i class="fa fa-trash-o fa-lg"></i> 
									</a>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="7"><p class="alert alert-danger">No Bid posted..</p></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php $this->pagination->showPagging($this->dataauction->countData($this->session->userdata("auction_search")),base_url("auction/bid/?id=$_GET[id]"),"left",@$_GET['page'],$limit);?>
	</div>
</div>