<?php 
	$user = $this->session->userdata("user");
	$sesi = $this->datagood->getdetailbankedit($_GET['id']);
?>

<div class="container">
	<div class="col-sm-12">
		<h2><i class="ion-ios-cart orange"></i> Add Your Bank Account</h2>
		<hr>
		<form action="<?=base_url()?>good/updatebankprocess" method="POST" enctype="multipart/form-data">
			<div class="row form-group">
				<label class="col-sm-2">
					Bank
				</label>
				<input type="hidden" name="id_detbank" value="<?=$sesi->id_detailbank;?>">
				<div class="col-sm-3">				
					<select class="form-control" name="id_bank" id="location" required="">
						<?php 
							$option = $this->datagood->getListBank2();
							foreach($option as $key=>$val){
									if($sesi->id_bank==$val->id_bank){
									echo "<option value='$val->id_bank' selected>$val->name_bank</option>";
								}else{
									echo "<option value='$val->id_bank'>$val->name_bank</option>";
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Account
				</label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" class="form-control" name="account_name" value="<?=$sesi->name_account;?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Number
				</label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" class="form-control" name="number_bank" value="<?=$sesi->number_bank;?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Location
				</label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" class="form-control" name="location" value="<?=$sesi->location_bank;?>">
					</div>
				</div>
			</div>
			<div class="form-group row">
							<label class="col-sm-3">
								status
							</label>
							<div class="col-sm-2">
								<label for="warnme">
									<?php if ($sesi->status==1) {
										?>
										<input type="checkbox" name="status" value="1"  id="warnme" checked> 
									<?php } else{
										?>
										<input type="checkbox" name="status" value="1"  id="warnme"> 
										<?php
										}?>

									Active
								</label>
							</div>
						</div>
			
			<div class="row form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-orange btn-md">Submit</button>
					<button type="reset" class="btn btn-red btn-md">Reset</button>
					<button type="button" class="btn btn-warning btn-md" onclick="document.location='<?=base_url()?>good/lists/';">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>






