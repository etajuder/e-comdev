<div class="container">
	<?php
	if($this->session->userdata("user")){
		redirect("dev/$user[username]");
		exit();
	}
	$sesi = $this->session->userdata("register_data");
	?>
	<div class="text-center">
		<h1>Register Your Account (it is FREE!!)</h1>
		<h4>Introduction text if the user have an account in ichibanlist.com</h4>
		<div class="row">
			<div class="col-md-8 col-xs-10 col-sm-6 col-sm-offset-3 col-md-offset-2 col-xs-offset-1">
				<div class="col-sm-5 well login-box">
					<h3>Register an Account</h3>
					<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/registerProcess" method="POST">
							<!--<a class="btn btn-facebook" href="https://www.facebook.com/dialog/oauth?client_id=418293264975105&redirect_uri=http://<?php //print $_SERVER['HTTP_HOST'];?>/login/&scope=publish_stream,email"><i class="fa fa-facebook"></i> via facebook</a>-->
							<!--<a class="btn btn-twitter" href="http://<?php //print $_SERVER['HTTP_HOST']?>/login/?register_via_twitter=true"><i class="fa fa-twitter"></i> via twitter</a>-->
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-android-person icon-big"></i></span>
								<input type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="Your first name" required="" value="<?=$sesi['first_name'];?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-android-person icon-big"></i></span>
								<input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Your last name" required="" value="<?=$sesi['last_name'];?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-email icon-big"></i></span>
								<input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email address" required="" value="<?=$sesi['email'];?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-telephone icon-big"></i></span>
								<input name="phone" type="text" class="form-control" id="exampleInputEmail1" placeholder="Your phone number" required="" value="<?=$sesi['phone'];?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-android-lock icon-big"></i></span>
								<input name="password" type="password" class="form-control" id="password" required="" placeholder="Your Password" >
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-location"></i></span>
								<select name="id_location" class="form-control" id="password" required="">
									<?php 
										$option = $this->datauser->getListLocation();
										foreach($option as $key=>$val){
											if($sesi['id_location']==$val->id_location){
												print "<option value='".$val->id_location."' selected>".$val->name_location."</option>";
											}else{
												print "<option value='".$val->id_location."'>".$val->name_location."</option>";
											}
										}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-orange btn-md">Register</button>
							<button type="reset" class="btn btn-red btn-md">Reset</button>
						</div>
					</form>
				</div>	
				<div class="col-sm-2"></div>
				<div class="col-sm-5 well login-box">
					<h3>Register with Social</h3>
					<p>
						Now, you can register an account with your social media account only with one touch!
					</p>
					<p>
						<a class="btn btn-default btn-square orange" href="https://www.facebook.com/dialog/oauth?client_id=<?php print $this->config->item('facebook_app_id');?>&redirect_uri=<?php print $this->config->item('facebook_register_oauth_url');?>&scope=public_profile,email">
							<i class="ion-social-facebook oversize"></i>
						</a>
						
						<a class="btn btn-default btn-square orange" href="<?=base_url();?>user/authregistertwitter?register_via_twitter=true">
							<i class="ion-social-twitter oversize"></i>
						</a>
					</p>
					
					<p>
						The button will redirect you to your social media pages and asking for a permission from you.
					</p>
					
				</div>	
			</div>
		</div>
	</div>
</div>
		