<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model("datauser");
		$this->load->library("pagination");
	} 
	
	public function index()
	{
		$this->load->view('content/body',array("content" => "content/404"));
	}
	
	public function createMessage(){
		$user = $this->session->userdata("user");
		if(is_array($user)){
			if($this->uri->segment(3)!=""){
				$data = array(
					"user_st"		=> $this->uri->segment(3),
					"user_nd"		=> $user['id_user'],
					"time_update"	=> time()
				);
				$return = $this->datauser->createMessage($data);
				if($return){
					redirect(base_url("message/conversation/".$return));
				}else{
					redirect(base_url("message/"));
				}
			}
		}else{
			$this->session->set_flashdata("message",array("danger","Login first!"));
			redirect(base_url("user/login"));
		}
	}
	
	public function login(){
		$this->config->load("setting");
		$this->load->view('content/body',array("content" => "user/login"));
	}
	
	public function profile(){
		$this->config->load("setting");
		$user = $this->session->userdata("user");
		if(!in_array(@$user['level'],array("user","admin"))){
			redirect(base_url());
			break;
		}else{
			$this->load->view('content/body',array("content" => "user/profile"));
		}
	}
	
	public function register(){
		$this->config->load("setting");
		$this->load->view('content/body',array("content" => "user/register"));
	}
	
	public function reset(){
		$this->load->view('content/body',array("content" => "user/reset"));
	}
	
	public function logout(){
		$this->session->set_userdata("user",null);
		redirect(base_url());
	}
	
	public function uploadPhoto(){
		$config['upload_path'] 		= './assets/uploads/';
		$config['allowed_types'] 	= 'jpg|png|gif|jpeg';
		$config['max_size']			= '10000'; //== 10 MB
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('filePhoto')){
			$error = array('error' => $this->upload->display_errors());
			echo json_encode(array('status' => $error['error']));
		}else{
			$result = array('upload_data' => $this->upload->data());
			$path 	= "assets/uploads/".$result['upload_data']['file_name'];
			
			$config = null;
			$config['image_library'] 	= 'gd2';
			$config['source_image']		= "assets/uploads/".$result['upload_data']['file_name'];
			$config['maintain_ratio'] 	= TRUE;
			$config['width']			= 100;
			$config['height']			= 100;
			$config['new_image']		= "assets/uploads/thumb_".$result['upload_data']['file_name'];
			
			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();
			unlink($config['source_image']);
			
			$data = array(
				"path"	=> $config['new_image']
			);
			print(json_encode($data));
		}
		
		exit;
	}
	
	public function auth(){
		$data = array(
			"email"	=> $_POST['email'],
			"password"	=> $_POST['password'],
		);
		
		$rules = array(
			array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'required|valid_email'
                ),
			array(
                     'field'   => 'password', 
                     'label'   => 'Password', 
                     'rules'   => 'required'
                )
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			$result = $this->datauser->getUserLogin($data);
			if($result){
				$this->session->set_userdata("user",(array)$result[0]);
				redirect(base_url('user/profile'));
			}else{
				$this->session->set_flashdata("message",array("danger","Email or password incorrect!"));
				redirect(base_url("user/login"));
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors())); 
			redirect(base_url("user/login"));
		}
		
	}
	
	public function changePassword(){
		$user = $this->session->userdata("user");
		if(@$_POST['new_password']!=""){
			if(@$_POST['new_password']!= @$_POST['new_password_retype']){
				$this->session->set_flashdata("message",array("danger","You retype different password."));
				redirect(base_url("user/profile"));
			}else{
				$data['id_user']	= $user['id_user'];
				$data['password'] 	= md5($_POST['new_password']);
				$result = $this->datauser->updateProfile($data);
				if($result){
					$this->session->set_flashdata("message",array("success","Your password successfully updated. Please re-login."));
					$this->session->set_userdata("user",null);
					redirect(base_url("user/login"));
				}else{
					$this->session->set_flashdata("message",array("danger","Failed to update profile!"));
					redirect(base_url("user/profile"));
				}
			}
		}
	}
	
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		return substr(str_shuffle($chars),0,$length);
	}
	
	public function resetAction(){
		$this->config->load('setting');
		$data = array(
			"email"			=> $_POST['email'],
		);
		$rules = array(
			array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'required|valid_email'
                )
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			if(!$this->datauser->cekEmailExist($data['email'])){
				$this->session->set_flashdata("message",array("danger","Email not registered!"));
				redirect(base_url("user/reset"));
			}else{
				$user 				= $this->datauser->getDetailUserByEmail($data['email']);
				$user 				= (object)$user[0];
				$new_password 		= $this->rand_string(6);
				$data["id_user"]	= $user->id_user;
				$data['password']	= md5($new_password);
				$result = $this->datauser->updateProfile($data);
				if($result){
					$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';	
					$name = $user->first_name;
					$html = "<p>Hi, $name</p><p>Here is your new password: $new_password</p><p>== ichibanlist.com ==</p>";		
					$postString = '{
						"key": "'.$this->config->item('mandrill_key').'",
						"message": {    
							"html": "'.$html.'",    
							"subject": "Reset Password - ichibanlist.com",    
							"from_email": "'.$this->config->item('site_email_sender_addresss').'",    
							"from_name": "'.$this->config->item('site_email_sender').'",    
							"to": [        
								{           
									"email": "'.$user->email.'",           
									"name": "'.$user->first_name.'"        
								}   
							],    
							"headers": {    },    
							"track_opens": true,    
							"track_clicks": true,    
							"auto_text": true,    
							"url_strip_qs": true,    
							"preserve_recipients": true,    
							"merge": true,    
							"global_merge_vars": [    ],    
							"merge_vars": [    ],    
							"tags": [    ],    
							"google_analytics_domains": [    ],    
							"google_analytics_campaign": "...",    
							"metadata": [    ],    
							"recipient_metadata": [    ],    
							"attachments": [    ]
						},
						"async": false}';
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $uri);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
					$result = curl_exec($ch);
					
					$this->session->set_flashdata("message",array("success","Your profile successfully updated."));
					redirect(base_url("user/login"));
				}else{
					$this->session->set_flashdata("message",array("danger","Failed to update profile!"));
					redirect(base_url("user/reset"));
				}
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("user/reset"));
		}
	}
	
	public function registerProcess(){
		$this->load->config("setting");
		$data = array(
			"email"			=> $_POST['email'],
			"first_name"	=> $_POST['first_name'],
			"last_name"		=> $_POST['last_name'],
			"phone"			=> $_POST['phone'],
			"id_location"	=> $_POST['id_location'],
			"level"			=> "user"
		);
		$rules = array(
			array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'required|valid_email'
                ),
			array(
                     'field'   => 'first_name', 
                     'label'   => 'First Name', 
                     'rules'   => 'required'
                ),
			array(
                     'field'   => 'phone', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|numeric'
                ),
		);
		
		$this->session->set_userdata("register_data",$data);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			if($this->datauser->cekEmailExist($data['email'])){
				$this->session->set_flashdata("message",array("danger","Email already exist! Please choose the other one."));
				redirect(base_url("user/register"));
			}else{
				$data['password'] = md5($_POST['password']);
				$result = $this->datauser->createUser($data);
				if($result){
					$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';	
					$name = $data['first_name'];
					$html = "<p>Hi, $name</p><p>Congratulations! You have registered on ichibanlist.com</p><p>== ichibanlist.com ==</p>";		
					$postString = '{
						"key": "'.$this->config->item('mandrill_key').'",
						"message": {    
							"html": "'.$html.'",    
							"subject": "Registration - ichibanlist.com",    
							"from_email": "'.$this->config->item('site_email_sender_addresss').'",    
							"from_name": "'.$this->config->item('site_email_sender').'",    
							"to": [        
								{           
									"email": "'.$data['email'].'",           
									"name": "'.$data['first_name'].'"        
								}   
							],    
							"headers": {    },    
							"track_opens": true,    
							"track_clicks": true,    
							"auto_text": true,    
							"url_strip_qs": true,    
							"preserve_recipients": true,    
							"merge": true,    
							"global_merge_vars": [    ],    
							"merge_vars": [    ],    
							"tags": [    ],    
							"google_analytics_domains": [    ],    
							"google_analytics_campaign": "...",    
							"metadata": [    ],    
							"recipient_metadata": [    ],    
							"attachments": [    ]
						},
						"async": false}';
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $uri);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
					$result = curl_exec($ch);
					
					
					$this->session->set_userdata("register_data",null);
					
					$this->session->set_flashdata("message",array("success","Your account has been created successfully."));
					redirect(base_url("user/login"));
				}else{
					$this->session->set_flashdata("message",array("danger","Failed to update profile!"));
					redirect(base_url("user/register"));
				}
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("user/register"));
		}
	}
	
	public function updateAlertSetting(){
		$user = $this->session->userdata("user");
		$data = array(
			"id_user"		=> $user['id_user'],
			"alert_me"		=> @$_POST['alert_new_post'],
		);
		
		$result = $this->datauser->updateProfile($data);
		if($result){
			$this->session->set_flashdata("message",array("success","Your profile successfully updated."));
			redirect(base_url("user/profile"));
		}else{
			$this->session->set_flashdata("message",array("danger","Failed to update profile!"));
			redirect(base_url("user/profile"));
		}
	}
	
	public function updateProfile(){
		$user = $this->session->userdata("user");
		$data = array(
			"id_user"		=> $user['id_user'],
			"email"			=> $_POST['email'],
			"first_name"	=> $_POST['first_name'],
			"last_name"		=> $_POST['last_name'],
			"phone"			=> $_POST['phone'],
			"about_me"		=> $_POST['about_me'],
			"avatar"		=> $_POST['avatar'],
			"id_location"	=> $_POST['id_location'],
			"dateofbirth"   => $_POST['dateofbirth']
		);
		$rules = array(
			array(
                     'field'   => 'email', 
                     'label'   => 'Email', 
                     'rules'   => 'required|valid_email'
                ),
			array(
                     'field'   => 'first_name', 
                     'label'   => 'First Name', 
                     'rules'   => 'required'
                ),
			array(
                     'field'   => 'phone', 
                     'label'   => 'Phone Number', 
                     'rules'   => 'required|numeric'
                ),
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			if($_POST['old_email']!=$data['email'] && $this->datauser->cekEmailExist($data['email'])){
				$this->session->set_flashdata("message",array("danger","Email already exist! Please choose the other one."));
				redirect(base_url("user/profile"));
			}else{
				$result = $this->datauser->updateProfile($data);
				if($result){
					$this->session->set_flashdata("message",array("success","Your profile successfully updated."));
					redirect(base_url("user/profile"));
				}else{
					$this->session->set_flashdata("message",array("danger","Failed to update profile!"));
					redirect(base_url("user/profile"));
				}
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("user/profile"));
		}
	}
	
	public function authregisterfacebook(){
		$user = $this->session->userdata("user");
		if(@$_REQUEST['code']!=""){
			$this->config->load('setting');
			$app_id 	= $this->config->item('facebook_app_id');
			$app_secret = $this->config->item('facebook_app_secret');
			$my_url 	= $this->config->item('facebook_register_oauth_url');
			$code		= $_REQUEST['code'];
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=public_profile,email";
			$response = @file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);					
			$graph_url 		= "https://graph.facebook.com/me?fields=first_name,last_name,email&access_token=".$params['access_token'];

			$result 		= json_decode(file_get_contents($graph_url));
			$email 			= $result->email;
			$facebook_id	= $result->id;
			
			if(!$this->datauser->cekUserExistByOpenID($result->id,"facebook_id")){
				$data = array(
					"first_name"		=> $result->first_name,
					"last_name"			=> $result->last_name,
					"email"				=> $result->email,
					"facebook_id"		=> $result->id,
					"username"			=> $result->email,
					"level"				=> "user",
				);
				
				$createUser = $this->datauser->createUser($data);
				if($createUser){
					$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';	
					$name = $data['first_name'];
					$html = "<p>Hi, $name</p><p>Congratulations! You have registered on ichibanlist.com</p><p>== ichibanlist.com ==</p>";		
					$postString = '{
						"key": "'.$this->config->item('mandrill_key').'",
						"message": {    
							"html": "'.$html.'",    
							"subject": "Registration - ichibanlist.com",    
							"from_email": "'.$this->config->item('site_email_sender_addresss').'",    
							"from_name": "'.$this->config->item('site_email_sender').'",    
							"to": [        
								{           
									"email": "'.$data['email'].'",           
									"name": "'.$data['first_name'].'"        
								}   
							],    
							"headers": {    },    
							"track_opens": true,    
							"track_clicks": true,    
							"auto_text": true,    
							"url_strip_qs": true,    
							"preserve_recipients": true,    
							"merge": true,    
							"global_merge_vars": [    ],    
							"merge_vars": [    ],    
							"tags": [    ],    
							"google_analytics_domains": [    ],    
							"google_analytics_campaign": "...",    
							"metadata": [    ],    
							"recipient_metadata": [    ],    
							"attachments": [    ]
						},
						"async": false}';
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $uri);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
					$result = curl_exec($ch);
					
					$result = $this->datauser->getUserLoginByOpenID($facebook_id,"facebook_id");
			                if($result){
				            $this->session->set_userdata("user",(array)$result[0]);
				            redirect(base_url('user/profile'));
			                }
				}else{  
					$this->session->set_flashdata("message",array("danger","Failed to create your account!"));
					redirect(base_url("user/register"));
				}
			}else{
				$this->session->set_flashdata("message",array("danger","Your facebook account has been registered!"));
				redirect(base_url("user/login"));
			}
		}
	}
	
	public function authviafacebook(){
		$user = $this->session->userdata("user");
		if(@$_REQUEST['code']!=""){
			$this->config->load('setting');
			$app_id 	= $this->config->item('facebook_app_id');
			$app_secret = $this->config->item('facebook_app_secret');
			$my_url 	= $this->config->item('facebook_profile_oauth_url');
			$code		= $_REQUEST['code'];
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=public_profile,email";
			$response = @file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);					
			$graph_url 		= "https://graph.facebook.com/me?access_token=".$params['access_token'];
			$result 		= json_decode(file_get_contents($graph_url));
			$email 			= $result->email;
			$facebook_id	= $result->id;
			
			$data = array(
				"id_user"		=> $user['id_user'],
				"facebook_id"	=> $facebook_id,
			);
			
			$setSocialID = $this->datauser->updateProfile($data);
			if($setSocialID){
				$this->session->set_flashdata("message",array("success","Your facebook account already connected to your ichibanlist.com account."));
				redirect(base_url("user/profile")); 
			}else{  
				$this->session->set_flashdata("message",array("danger","Failed to connect to your profile!"));
				redirect(base_url("user/profile"));
			}
		}
	}
	
	public function authloginfacebook(){
		if(@$_REQUEST['code']!=""){
			$this->config->load('setting');
			$app_id 	= $this->config->item('facebook_app_id');
			$app_secret = $this->config->item('facebook_app_secret');
			$my_url 	= $this->config->item('facebook_login_oauth_url');
			$code		= $_REQUEST['code'];
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=public_profile,email";
			$response = @file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);					
			$graph_url 		= "https://graph.facebook.com/me?access_token=".$params['access_token'];
			$result 		= json_decode(file_get_contents($graph_url));
			$data			= $result->id;
			$result = $this->datauser->getUserLoginByOpenID($data,"facebook_id");
			if($result){
				$this->session->set_userdata("user",(array)$result[0]);
				redirect(base_url('user/profile'));
			}else{
				$this->session->set_flashdata("message",array("danger","You are not registered! Please register or set your account to be connected to this social media account."));
				redirect(base_url("user/login"));
			}
		}
	}
	
	public function authlogintwitter(){
		$user = $this->session->userdata("user");
		$this->load->library('twitteroauth');
		$this->config->load('setting');
		$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		
		
		$request_token = $this->twitterconnection->getRequestToken(base_url('/user/authlogintwitterProcess'));
		$this->session->set_userdata('request_token', $request_token['oauth_token']);
		$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
		
		if($this->twitterconnection->http_code == 200){
			$url = $this->twitterconnection->getAuthorizeURL($request_token);
			redirect($url);
		}else{
			redirect(base_url('/'));
		}
	}
	
	public function authregistertwitter(){
		$user = $this->session->userdata("user");
		$this->load->library('twitteroauth');
		$this->config->load('setting');
		$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		
		
		$request_token = $this->twitterconnection->getRequestToken(base_url('/user/authregistertwitterProcess'));
		$this->session->set_userdata('request_token', $request_token['oauth_token']);
		$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
		
		if($this->twitterconnection->http_code == 200){
			$url = $this->twitterconnection->getAuthorizeURL($request_token);
			redirect($url);
		}else{
			redirect(base_url('/'));
		}
	}
	
	public function createTwitterOauthRequest(){
		$user = $this->session->userdata("user");
		if(is_array($user)){
			$this->load->library('twitteroauth');
			$this->config->load('setting');
			$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
			
			
			$request_token = $this->twitterconnection->getRequestToken(base_url('/user/twitterOauthCallBack'));
			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->twitterconnection->http_code == 200){
				$url = $this->twitterconnection->getAuthorizeURL($request_token);
				redirect($url);
			}else{
				redirect(base_url('/'));
			}
		}
	}
	
	public function twitterOauthCallBack(){
		$user = $this->session->userdata("user");
		$this->load->library("twitteroauth");
		$this->config->load('setting');
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')){
			$this->reset_session();
			redirect(base_url('/twitter/auth'));
		}else{
			$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
			$access_token = (object)$this->twitterconnection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->twitterconnection->http_code == 200){
				$data = array(
					"id_user"		=> $user['id_user'],
					"twitter_id"	=> $access_token->user_id,  
				);
				
				$setSocialID = $this->datauser->updateProfile($data);
				if($setSocialID){
					$this->session->set_flashdata("message",array("success","Your twitter account already connected to your ichibanlist.com account."));
					redirect(base_url("user/profile"));
				}else{  
					$this->session->set_flashdata("message",array("danger","Failed to connect to your profile!"));
					redirect(base_url("user/profile"));
				}
			}else{ 
				redirect(base_url('user/profile'));
			}
		}
	}
	
	public function authlogintwitterProcess(){
		$user = $this->session->userdata("user");
		$this->load->library("twitteroauth");
		$this->config->load('setting');
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')){
			$this->reset_session();
			redirect(base_url('/twitter/auth'));
		}else{
			$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
			$access_token = (object)$this->twitterconnection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->twitterconnection->http_code == 200){
				$result = $this->datauser->getUserLoginByOpenID($access_token->user_id,"twitter_id");
				if($result){
					$this->session->set_userdata("user",(array)$result[0]);
					redirect(base_url('user/profile'));
				}else{
					$this->session->set_flashdata("message",array("danger","You are not registered! Please register or set your account to be connected to this social media account."));
					redirect(base_url("user/login"));
				}
			}else{ 
				$this->session->set_flashdata("message",array("danger","Login process failed!"));
				redirect(base_url("user/login"));
			}
		}
	}
	
	public function authregistertwitterProcess(){
		$user = $this->session->userdata("user");
		$this->load->library("twitteroauth");
		$this->config->load('setting');
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token')){
			$this->reset_session();
			redirect(base_url('/twitter/auth'));
		}else{
			$this->twitterconnection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
			$access_token = (object)$this->twitterconnection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->twitterconnection->http_code == 200){
				if(!$this->datauser->cekUserExistByOpenID($access_token->user_id,"twitter_id")){
					$data = array(
						"first_name"		=> $access_token->screen_name,
						"twitter_id"		=> $access_token->user_id,
						"username"			=> $access_token->screen_name,
						"level"				=> "user",
					);
					
					$createUser = $this->datauser->createUser($data);
					if($createUser){
						$result = $this->datauser->getUserLoginByOpenID($access_token->user_id,"twitter_id");
						if($result){
							$this->session->set_userdata("user",(array)$result[0]);
							redirect(base_url('user/profile'));
						}
					}else{  
						$this->session->set_flashdata("message",array("danger","Failed to create your account!"));
						redirect(base_url("user/register"));
					}
				}else{
					$this->session->set_flashdata("message",array("danger","Your twitter account has been registered!"));
					redirect(base_url("user/login"));
				}
			}else{ 
				$this->session->set_flashdata("message",array("danger","Login process failed!"));
				redirect(base_url("user/login"));
			}
		}
	}
}