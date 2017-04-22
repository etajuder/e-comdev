<?php 
	$user = $this->session->userdata("user");
?>
<div class="container">
	<div class="col-sm-12">
		<h2><i class="fa fa-shopping-cart"></i> Your Items</h2>
		<hr>
		<div class="row search-block">
			<div class="col-sm-4 pull-left col-xs-8">
				<form method="POST" action="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control" name="keyword" value="<?=$this->session->userdata("good_search")?>" placeholder="Search your keyword + Enter">
					</div>
				</form>
			</div>
			<div class="col-sm-4 col-xs-4 pull-right">
				<div class="pull-right">
					<a href="<?=base_url()?>good/add" class="btn btn-orange"><i class="ion-android-add-circle"></i> Add item</a>
				</div>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<!--<th>No.</th>-->
					<th>Title</th>
					<th>Price</th>
					<th>Attachment</th>
					<th>City</th>
					<th>Updated</th>
					<th>Viewer</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$option = $this->datagood->getListLocation();
					foreach($option as $key=>$val){
						$kota[$val->id_location] = $val->name_location;
					}
					$keyword = explode(" ", $this->session->userdata("good_search"));
					
					$limit = 15;
					$lists = $this->datagood->getListOfdata(@$_GET['page'],$limit,$user['id_user'],array("keyword"=>$keyword));
					$no    = @$_GET['page'];
					if($no==""){ $no = 0;}else{ $no = ($no-1)*$limit;}
					if(count($lists)>0){
						foreach($lists as $key=>$val){
							$no++;
							?>
							<tr>
								<!--<td><?//=$no?></td>-->
								<td><a class="orange" href="<?=base_url()?>good/post/<?=$val->url_post?>"><?=$val->title;?></a></td>
								<td><span class="pull-left"><i class="fa fa-yen"></i></span><span class="pull-right"> <?=number_format($val->amount);?></span></td>
								<td class="text-right">
									<?=$this->datagood->getTotalPhoto($val->id_post);?> photo(s)
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
									<a href="<?=base_url();?>good/edit/?id=<?=$val->id_post?>" class="orange">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
									
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>good/delete/?id=<?=$val->id_post?>'; }" class="red">
										 <i class="fa fa-trash-o fa-lg"></i> 
									</a>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="7"><p class="alert alert-danger">No item posted..</p></td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php $this->pagination->showPagging($this->datagood->countData($this->session->userdata("good_search")),base_url("good/lists"),"left",@$_GET['page'],$limit);?>
	</div>
</div>