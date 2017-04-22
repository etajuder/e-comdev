<div class="container">
	<?php
	$user = $this->session->userdata("user");
	$sesi = $this->datauser->getDetailUser($user['id_user']);
	?>
	<div class="col-sm-12">
		<h2><i class="fa fa-pencil"></i> Your Profile</h2>
		<hr>
			<div class="row">
				<div class="col-sm-6">
					<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/updateProfile" method="POST">
						<div class="form-group row">
							<label class="col-sm-4">
								Avatar
							</label>
							<div class="col-sm-8">
								<div id="avatar-photo" style="max-width:100px;">
								<?php 
									if($sesi->avatar!=""){
										?><img src="<?=base_url();?><?=$sesi->avatar;?>" style="max-height:100px;" class="img-thumbnail"><?php
									}else{
										?><img src="<?=base_url();?>assets/img/no-photo.png" style="max-height:100px;" class="img-thumbnail"><?php
									}
								?>
								</div>
								<br>
								<input type="hidden" class="form-control" name="avatar" id="avatarpath" placeholder="Avatar path" required="" value="<?=$sesi->avatar?>">
								<button type="button" class="btn btn-blue" data-toggle="modal" data-target="#uploadphotomodal"><i class="ion-camera"></i> Choose avatar</button>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4">
								First name 
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="ion-android-person icon-big"></i></span>
									<input type="text" class="form-control" name="first_name" id="exampleInputEmail1" placeholder="Your first name" required="" value="<?=$sesi->first_name?>">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4">
								Last name
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="ion-android-person icon-big"></i></span>
									<input type="text" class="form-control" name="last_name" id="exampleInputEmail1" placeholder="Your last name" required="" value="<?=$sesi->last_name?>">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4">
								Email address
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-email icon-big"></i></span>
									<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email address" required="" value="<?=$sesi->email?>">
									<input type="hidden" class="form-control" name="old_email" id="exampleInputEmail1" placeholder="Enter email address" required="" value="<?=$sesi->email?>">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4">
								Phone number
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-telephone icon-big"></i></span>
									<input type="text" class="form-control" name="phone" id="exampleInputEmail1" placeholder="Your phone number" required="" value="<?=$sesi->phone?>">
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4">
								My current location
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-location"></i></span>
									<select name="id_location" class="form-control" id="password" required="">
										<?php 
											$option = $this->datauser->getListLocation();
											foreach($option as $key=>$val){
												if($sesi->id_location==$val->id_location){
													print "<option value='".$val->id_location."' selected>".$val->name_location."</option>";
												}else{
													print "<option value='".$val->id_location."'>".$val->name_location."</option>";
												}
											}
										?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4">
								About me
							</label>
							<div class="col-sm-8">
									<textarea  rows="5" placeholder="Write something about you" name="about_me" required="" class="form-control"><?=$sesi->about_me?></textarea>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-4">
								<button type="submit" class="btn btn-orange btn-md">Save changes</button>
								<button type="reset" class="btn btn-red btn-md">Reset</button>
							</div>
						</div>
					</form>
					<hr>
					<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/changePassword" method="POST">
						<div class="form-group row">
							<label class="col-sm-4">
								Change Password
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
									<input type="password" class="form-control" name="new_password" id="exampleInputEmail1" placeholder="" required="">
								</div>
								<p class="help-block">Leave it blank, if you do not want to change your password.</p>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4">
								Retype New Password
							</label>
							<div class="col-sm-8">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock"></i></span>
									<input type="password" class="form-control" name="new_password_retype" id="exampleInputEmail1" placeholder="" required="">
								</div>
								<p class="help-block">Retype your new password if you want to change your password.</p>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-4">
								<button type="submit" class="btn btn-orange btn-md">Change password</button>
								<button type="reset" class="btn btn-red btn-md">Reset</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<h4>Your open / social ID</h4>
					<hr>
					<div class="form-group row">
						<label class="col-sm-4">
							Facebook 
						</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook-square"></i></span>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Not set up yet" required="" value="<?=$sesi->facebook_id?>" readonly>
							</div>
							<br>
							
							<a class="btn btn-default btn-square btn-primary" href="https://www.facebook.com/dialog/oauth?client_id=<?php print $this->config->item("facebook_app_id");?>&redirect_uri=<?php print $this->config->item("facebook_profile_oauth_url");?>&scope=publish_stream,email">
								<?php if($sesi->facebook_id!=""){ ?>
								change / update 
								<?php }else{ ?>
								set up
								<?php } ?>
							</a>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-4">
							Twitter 
						</label> 
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-twitter-square"></i></span>
								<input type="first_name" class="form-control" id="exampleInputEmail1" placeholder="Not set up yet" required="" value="<?=$sesi->twitter_id?>" readonly>
							</div>
							<br>
							<a class="btn btn-default btn-square btn-info" href="<?=base_url();?>user/createTwitterOauthRequest">
								<?php if($sesi->twitter_id!=""){ ?>
								change / update 
								<?php }else{ ?>
								set up
								<?php } ?>
							</a>
						</div>
					</div>
					
					<h4>Email &amp; Notifications</h4>
					<hr>
					<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/updateAlertSetting" method="POST">
						<div class="form-group row">
							<label class="col-sm-4">
								New Item / Job
							</label>
							<div class="col-sm-8">
								<label for="warnme">
									<input type="checkbox" name="alert_new_post" value="yes" <?=($sesi->alert_me=="yes") ? "checked" : "";?> id="warnme">
									 Please notify me if a new item/job with same city with my current location posted.
								</label>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-sm-8 col-sm-offset-4">
								<button type="submit" class="btn btn-orange btn-md">Save changes</button>
								<button type="reset" class="btn btn-red btn-md">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
</div>
<div class="modal fade" id="uploadphotomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload photo</h4>
			</div>
			<div class="modal-body text-center">
				<form method="POST" enctype="multipart/form-data" id="uploadPhotoForm" action="<?php print base_url("user/uploadPhoto");?>">
					<div id="progressloading" style="display:none;">
						<i class="fa fa-spinner fa-pulse big-icon"></i> Uploading..
					</div>
					<div id="errorUpload" style="display:none">
						 
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="file" name="filePhoto" class="form-control" id="filePhoto">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<button type="submit" class="btn btn-blue"><i class="ion-ios-cloud-upload-outline"></i> Upload</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$("#uploadPhotoForm").submit(function( event ) {
		event.preventDefault();
		$("#progressloading").show();
		$("#errorUpload").hide();
		$.ajax({
			url:"<?=base_url("user/uploadPhoto")?>",
			type:"POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
		})
		.done(function(result){
			var data = JSON.parse(result);
			var photoURL 	= data.path;
			var htmlcontent = "<img src=\"<?=base_url()?>"+photoURL+"\" class=\"img-thumbnail\" style=\"max-height:100px;\">";
			$("#avatarpath").val(data.path);
			$("#avatar-photo").html(htmlcontent);
			$("#filePhoto").val("");
			$("#uploadphotomodal").modal("hide");
			$("#progressloading").hide();
		})
		.fail(function(msg){
			$("#errorUpload").html("<p class='alert alert-danger'>Oops, an error occured. Please try again</p>");
			$("#errorUpload").show();
			$("#progressloading").hide();
		});
	});
</script>