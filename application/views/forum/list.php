<?php 
	$user = $this->session->userdata("user");
?>
<div class="container">
	<div class="col-sm-12">
		<h2><i class="fa fa-pencil"></i> Your Forum Threads</h2>
		<hr>
		<div class="row search-block">
			<div class="col-sm-4 pull-left col-xs-8">
				<form method="POST" action="">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<input type="text" class="form-control" name="keyword" value="<?=$this->session->userdata("forum_search")?>" placeholder="Search your keyword + Enter">
					</div>
				</form>
			</div>
			<div class="col-sm-4 col-xs-4 pull-right">
				<div class="pull-right">
					<a href="<?=base_url()?>forum/add" class="btn btn-orange"><i class="ion-android-add-circle"></i> Add thread</a>
				</div>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<!--<th>No.</th>-->
					<th>Title</th>
					<th>Category</th>
					<th>Attachment</th>
					<th>Updated</th>
					<th>Viewer</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$option = $this->dataforum->getListThread();
					foreach($option as $key=>$val){
						$thread[$val->id_thread] = $val->name_thread;
					}
					
					$keyword = explode(" ", $this->session->userdata("forum_search"));
					
					$limit = 15;
					$lists = $this->dataforum->getListOfdata(@$_GET['page'],$limit,$user['id_user'],array("keyword"=>$keyword));
					$no    = @$_GET['page'];
					if($no==""){ $no = 0;}else{ $no = ($no-1)*$limit;}
					if(count($lists)>0){
						foreach($lists as $key=>$val){
							$no++;
							?>
							<tr>
								<!--<td><?//=$no?></td>-->
								<td><a class="orange" href="<?=base_url()?>forum/post/<?=$val->url_post?>"><?=$val->title;?></a></td>
								<td class="text-right"><?=$thread[$val->id_category];?></td>
								<td class="text-right">
									<?=$this->dataforum->getTotalPhoto($val->id_post);?> photo(s)
									<?php 
										if($val->id_video!=""){
											echo " + 1 video";
										}
									?>
								</td>
								<td class="text-center"><?=date("Y.m.d H:i:s",$val->post_update_time);?></td>
								<td class="text-right"><?=number_format($val->viewer);?></td>
								<td class="text-center">
									<a href="<?=base_url();?>forum/edit/?id=<?=$val->id_post?>" class="orange">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
									
									<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>forum/delete/?id=<?=$val->id_post?>'; }" class="red">
										 <i class="fa fa-trash-o fa-lg"></i> 
									</a>
								</td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="7">no post found</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php $this->pagination->showPagging($this->dataforum->countData($this->session->userdata("forum_search")),base_url("forum/lists"),"left",@$_GET['page'],$limit);?>
	</div>
</div>