<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model("datauser");
		$this->load->library("pagination");
	}
	
	public function index()
	{
		$this->load->view('content/body',array("content" => "contact/contact_us"));
	}
	
	public function send_email(){
		$uri = 'https://mandrillapp.com/api/1.0/messages/send.json';	
		$html = "<p>Hi admin, a user/visitor sent you a message directly from http://".base_url()."/contact with these following details</p><p>Email: ".$_REQUEST['email']."<br>Full Name: ".$_REQUEST['nama_lengkap']."<br>Message:<br>".$_REQUEST['pesan'].".</p>";		
		$postString = '{
			"key": "'.$this->config->item('mandrill_key').'",
			"message": {    
				"html": "'.$html.'",    
				"subject": "Contact - Ichibanlist.com",    
				"from_email": "'.$_REQUEST['email'].'",    
				"from_name": "'.$_REQUEST['nama_lengkap'].'",    
				"to": [        
					{           
						"email": "psatriaw@gmail.com",           
						"name": "Administrator"        
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
		echo $result;
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
	
	public function updateProfile(){
		$user = $this->session->userdata("user");
		$data = array(
			"id_user"		=> $user['id_user'],
			"email"			=> $_POST['email'],
			"first_name"	=> $_POST['first_name'],
			"last_name"		=> $_POST['last_name'],
			"phone"			=> $_POST['phone'],
			"about_me"		=> $_POST['about_me']
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
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=publish_stream,email";
			$response = @file_get_contents($token_url);
			$params = null;
			parse_str($response, $params);					
			$graph_url 		= "https://graph.facebook.com/me?access_token=".$params['access_token'];
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
					$this->session->set_flashdata("message",array("success","Your account has been created successfully"));
					redirect(base_url("user/login")); 
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
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=publish_stream,email";
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
			$token_url 	= "https://graph.facebook.com/oauth/access_token?client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code."&scope=publish_stream,email";
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
						$this->session->set_flashdata("message",array("success","Your account has been created successfully"));
						redirect(base_url("user/login")); 
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