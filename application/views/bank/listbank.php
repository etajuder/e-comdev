<?php 
	$user = $this->session->userdata("user");
?>
<div class="container">
	<div class="col-sm-12">
		<h2><i class="fa fa-money"></i> Your Bank Accounts</h2>
		<hr>
		<div class="row search-block">
		
			<div class="col-sm-4 col-xs-4 pull-right">
				<div class="pull-right">
					<a href="<?=base_url()?>good/addBank" class="btn btn-orange"><i class="ion-android-add-circle"></i> Add Bank Account</a>
				</div>
			</div>
		</div>
		<table class="table table-striped">
			<thead>
				<tr>
					<!--<th>No.</th>-->
					<th>Bank</th>
					<th>Account</th>
					<th>Number </th>
					<th>Location</th>
					<th>status</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
					<?php
		$banks = $this->datagood->getListBank($user['id_user']);
		 foreach ($banks as $bank) {
		 	$data_stat = "";
		 	if ($bank->status==1) {
		 		$data_stat = "active";
		 	}else
		 	{
		 		$data_stat = "inactive";
		 	}
		 ?>
		 	<tr>
		 		<td class="text-center"><?=$bank->name_bank;?></td>
		 		<td class="text-center"><?=$bank->name_account;?></td>
		 		<td class="text-center"><?=$bank->number_bank;?></td>
		 		<td class="text-center"><?=$bank->location_bank;?></td>
		 		<td class="text-center"><?=$data_stat;?></td>
		 		<td class="text-center"><img src="<?php print base_url();?><?php print $bank->image_bank;?>" style="width:100px;"></td>
	 			<td class="text-center">
								<a href="<?=base_url();?>good/editbank/?id=<?=$bank->id_detailbank?>" class="orange">
									<i class="fa fa-pencil-square-o fa-lg"></i>
								</a>
								
								<a href="javascript:if(confirm('Are you sure?')){ document.location = '<?=base_url();?>good/deletebank/?id=<?=$bank->id_detailbank?>'; }" class="red">
									 <i class="fa fa-trash-o fa-lg"></i> 
								</a>
				</td>
		 	</tr>
		 <?php
		 }
		 ?>
			</tbody>
		</table>
	</div>
</div>