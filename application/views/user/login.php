<div class="container">
	<?php
	error_reporting(E_ALL);
	if(@$_REQUEST['code']!=""){
		$app_id 	= "1195666863821649";
		$app_secret = "cd89dc7376cc469979883378930dfa4b";
		$my_url 	= base_url()."user/authloginfacebook";
		$code		= $_REQUEST['code'];
		$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=publish_stream,email";
		$response = @file_get_contents($token_url);
		$params = null;
		parse_str($response, $params);					
		$graph_url = "https://graph.facebook.com/me?access_token=".$params['access_token'];
		$user = json_decode(file_get_contents($graph_url));
		$username = $user->username;
		$email = $user->email;
		$facebook_id = $user->id;
		
		$data = array(
			"username"		=> $user->id,
			"social_id"		=> $user->id,
			"email"			=> $user->email,
		);
		
		$rule = array(
			"email"		=> array("Email","required|email"),
			"social_id"	=> array("Akun sosial media","required")
		);
		
		
		if(cek_input($data,$rule)){
			$cek = $con->db->sql_query("SELECT * FROM tb_user WHERE username = '".$data['username']."' AND social_id='".$data['social_id']."'");
			if($con->db->sql_numrows($cek)>0){
				set_data("user",$con->db->sql_rincian($cek));
				$user = use_data("user");
				gotopage("dev/$user[username]");
			}else{
				set_message("DANGER|Maaf anda belum terdaftar, silahkan registrasi dengan akun sosial media anda!");
				show_message();
			}
		}else{
			set_message("ERROR|".show_thread());
			show_message();
		}
	}
	
	//=== AUTORISASI REGISTER DENGAN AKUN TWITTER ===
	define('CONSUMER_KEY', 'U8wdQIpuree4xna2sdxLorCvr');
	define('CONSUMER_SECRET', 'aYt86WsJP735FjNZ31EWYKluOjKObybnwo04JquXAfjGBED8HW');
	define('OAUTH_CALLBACK', 'http://diaryhijaber.com/login');

	// include_once("php_lib/inc/twitteroauth.php");

	if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']){
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		if($connection->http_code=='200')
		{
			$_SESSION['status'] 		= 'verified';
			$_SESSION['request_vars']	= $access_token;
			unset($_SESSION['token']);
			unset($_SESSION['token_secret']);
			
			$data = array(
				"username"		=> $access_token['user_id'],
				"social_id"		=> $access_token['user_id'],
				"email"			=> $access_token['screen_name'],
			);
			
			$rule = array(
				"email"		=> array("Email","required"),
				"social_id"	=> array("Akun sosial media","required")
			);
			
			
			if(cek_input($data,$rule)){
				$cek = $con->db->sql_query("SELECT * FROM tb_user WHERE username = '".$data['username']."' AND social_id='".$data['social_id']."'");
				if($con->db->sql_numrows($cek)>0){
					set_data("user",$con->db->sql_rincian($cek));
					$user = use_data("user");
					gotopage("dev/$user[username]");
				}else{
					set_message("DANGER|Maaf anda belum terdaftar, silahkan registrasi dengan akun sosial media anda!");
					show_message();
				}
			}else{
				set_message("ERROR|".show_thread());
				show_message();
			}
		}else{
			set_message("ERROR|Harap mengulangi lagi autorisasi register dengan akun twitter!");
			show_message();
		}
			
	}
	
	if(isset($_REQUEST["register_via_twitter"])){
		//== pertama untuk disiapkan 
		if(isset($_GET["denied"]))
		{
			set_message("ERROR|Error saat autorisasi register dengan akun twitter!");
			show_message();
		}

		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
		
		$_SESSION['token'] 			= $request_token['oauth_token'];
		$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
		
		if($connection->http_code=='200')
		{
			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
			header('Location: ' . $twitter_url); 
		}else{
			set_message("ERROR|Harap mengulangi lagi autorisasi register dengan akun twitter!");
			show_message();
		}
	}
	//============================================================================

	if(isset($_POST['login_submit'])){
		$data = array(
			"username"		=> $_POST['username'],
			"password"		=> md5($_POST['password'])
		);
		
		$rule = array(
			"username"		=> array("username","required"),
			"password"		=> array("Password","required"),
		);
		
		if(cek_input($data,$rule)){
			$cek = $con->db->sql_query("SELECT * FROM tb_user WHERE username = '".$data['username']."' AND password='".$data['password']."'");
			if($con->db->sql_numrows($cek)>0){
				set_data("user",$con->db->sql_rincian($cek));
				if($_POST['from']){
					if($_POST['from']=="upload_photo_contest"){
						gotopage("photo-contest/upload");
					}else{
						$user = use_data("user");
						gotopage("dev/$user[username]");
					}
				}else{
					$user = use_data("user");
					gotopage("dev/$user[username]");
				}
			}else{
				set_message("DANGER|Maaf username atau password tidak tepat!");
				show_message();
			}
		}else{
			set_message("ERROR|".show_thread());
			show_message();
		}
	}
	if($this->session->userdata("user")){
		redirect("dev/$user[username]");
		exit();
	}
	?>
	<div class="text-center">
		<h1><?=$this->lang->line("page_login_title");?></h1>
		<h4><?=$this->lang->line("page_login_description");?></h4>
		<div class="row">
			<div class="col-md-8 col-xs-10 col-sm-6 col-sm-offset-3 col-md-offset-2 col-xs-offset-1">
				<div class="col-sm-5 well login-box">
					<h3><?=$this->lang->line("page_login_via_account_title");?></h3>
					<form class="form-signin" data-ember-action="2" action="<?=base_url();?>user/auth" method="POST">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-email icon-big"></i></span>
								<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="<?=$this->lang->line("page_login_via_account_email_placeholder");?>" required="">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="ion-android-lock icon-big"></i></span>
								<input type="password" name="password" class="form-control" id="password" required="" placeholder="<?=$this->lang->line("page_login_via_account_password_placeholder");?>">
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-orange btn-md"><?=$this->lang->line("page_login_via_account_submit");?></button>
						</div>
					</form>
					
					<p><?=$this->lang->line("page_login_via_account_do_not_have_account");?><br>
						<a href="<?=base_url();?>user/register" class="ember-view btn btn-sm btn-register"> <?=$this->lang->line("page_login_via_account_register_link");?></a> 
					<br/>
					<strong><?=$this->lang->line("page_login_via_account_or");?></strong>
					<br/>
						<a href="<?=base_url();?>user/reset" class="ember-view btn btn-sm btn-login"> <?=$this->lang->line("page_login_via_account_forgot_link");?></a>
					</p>
				</div>	
				<div class="col-sm-2"></div>
				<div class="col-sm-5 well login-box">
					<h3><?=$this->lang->line("page_login_via_social_titile");?></h3>
					<p>
						<a class="btn btn-default btn-square orange" href="https://www.facebook.com/dialog/oauth?client_id=<?php print $this->config->item('facebook_app_id');?>&redirect_uri=<?php print $this->config->item('facebook_login_oauth_url');?>&scope=public_profile,email">
							<i class="ion-social-facebook oversize"></i>
						</a>
						
						<a class="btn btn-default btn-square orange" href="<?=base_url();?>user/authlogintwitter?register_via_twitter=true">
							<i class="ion-social-twitter oversize"></i>
						</a>
					</p>
					<p>
						<?=$this->lang->line("page_login_via_social_help_text");?>
					</p>
						
				</div>	
			</div>
		</div>
	</div>
</div>
		