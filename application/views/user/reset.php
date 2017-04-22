<div class="container">
	<div class="text-center">
		<h1>Reset Password</h1>
		<h4>Fill your email address, and we will send you a new password</h4>
		<div class="row">
			<div class="col-md-4 col-xs-8 col-sm-6 col-sm-offset-3 col-md-offset-4 col-xs-offset-2">
				<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/resetAction" method="POST">
					<div class="col-sm-12 well login-box">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-email icon-big"></i></span>
								<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email address" required="">
							</div>
						</div>
					</div>	
					<div class="form-group">
						<button type="submit" class="btn btn-orange btn-md">Send me a new password</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
		