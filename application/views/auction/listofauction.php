<?php 
	$user = $this->session->userdata("user");
?>
<div class="container">
	<div class="col-sm-12">
		<h2><i class="fa fa-shopping-cart"></i> Your Auction</h2>
		<hr>
		<div class="row search-block">
			<div class="col-sm-4 pull-left col-xs-8">
				<form method="POST" action="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control" name="keyword" value="<?=$this->session->userdata("auction_search")?>" placeholder="Search your keyword + Enter">
					</div>
				</form>
			</div>
			<div class="col-sm-4 col-xs-4 pull-right">
				<div class="pull-right">
					<a href="<?=base_url()?>auction/add" class="btn btn-orange"><i class="ion-android-add-circle"></i> Add Auction</a>
				</div>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<!--<th>No.</th>-->
					<th>Title</th>
					<th>Lowest Price</th>
					<th>Amount Bid</th>
					<th>Attachment</th>
					<th>City</th>
					<th>Updated</th>
					<th>Viewer</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$option = $this->dataauction->getListLocation();
					foreach($option as $key=>$val){
						$kota[$val->id_location] = $val->name_location;
					}
					$keyword = explode(" ", $this->session->userdata("auction_search"));
					
					$limit = 15;
					$lists = $this->dataauction->getListOfdata(@$_GET['page'],$limit,$user['id_user'],array("keyword"=>$keyword));
					$no    = @$_GET['page'];
					if($no==""){ $no = 0;}else{ $no = ($no-1)*$limit;}
					if(count($lists)>0){
						foreach($lists as $key=>$val){
							$no++;
							?>
							<tr>
								<!--<td><?//=$no?></td>-->
								<td><a class="orange" href="<?=base_url()?>auction/post/<?=$val->url_post?>"><?=$val->title;?></a></td>
								<td><span class="pull-left"><i class="fa fa-yen"></i></span><span class="pull-right"> <?=number_format($val->amount);?></span></td>
								<td><span class="pull-left"><i class="fa fa-yen"></i></span><span class="pull-right"> <?=number_format($val->amount_bid);?></span></td>
								<td class="text-right">
									<?=$this->dataauction->getTotalPhoto($val->id_post);?> photo(s)
									<?php 
										if($val->id_video!=""){
											echo " + 1 video";
										}
									?>
								</td>
								<td class="text-right"><?=$kota[$val->id_location];?></td>
								<td class="text-center"><?=date("Y.m.d H:i:s",$val->post_update_time);?></td>
								<td class="text-right"><?=number_format($val->viewer);?></td>
								<td class="text-center">
									<a href="<?=base_url();?>auction/edit/?id=<?=$val->id_post?>" class="orange">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>auction/delete/?id=<?=$val->id_post?>'; }" class="red">
										 <i class="fa fa-trash-o fa-lg"></i> 
									</a>
									<a href="<?=base_url();?>auction/bid/?id=<?=$val->id_post?>" class="orange" title="Bid History">
										<i class="fa fa-briefcase fa-lg"></i>
									</a>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="7"><p class="alert alert-danger">No Auction posted..</p></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php $this->pagination->showPagging($this->dataauction->countData($this->session->userdata("auction_search")),base_url("auction/lists"),"left",@$_GET['page'],$limit);?>
	</div>
</div>