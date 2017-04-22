<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Good extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array("datagood","datauser","dataitem","datalocation"));
		$this->load->library("pagination");
	}
	
	public function post(){
		$this->load->model("dataforum");
		$this->load->view('content/body',array("content" => "detail/detail_body"));
	}
	public function confirm(){
		$user = $this->session->userdata("user");
			if(!in_array(@$user['level'],array("user"))){
			redirect(base_url());
			break;
		}else{
		$this->load->view('content/body',array("content" => "confirm/form"));
		}
	}
	public function bank(){
		//$this->load->model("dataforum");
		$this->config->load("setting");
		$user = $this->session->userdata("user");
			if(!in_array(@$user['level'],array("user"))){
			redirect(base_url());
			break;
		}else{
		$this->load->view('content/body',array("content" => "bank/listbank"));
		}
	}
	public function addConfirm(){
		$this->load->config("setting");
		$user = $this->session->userdata("user");
		$item = $this->datagood->getDetail($_POST['id_post']);
		if(!empty($_FILES['confirm_file']['name'])){
		$config['upload_path'] 		= './assets/uploads/';
		$config['allowed_types'] 	= 'jpg|png|gif|jpeg';
		$config['max_size']			= '10000'; //== 10 MB
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('confirm_file')){
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
			
				$data = array(
			"id_user" 		=> $user['id_user'],
			"created_at"	=> time(),
			"note"		=> htmlspecialchars($_POST['note']),
			"id_post"		=> $_POST['id_post'],
			"id_bank"		=> $_POST['id_bank'],
			"amount"		=> $_POST['amount'],
			"file_confirm" =>$path
		);
			$insert = $this->datagood->insertConfirm($data);
			
			
		}
	}else{
			$data = array(
			"id_user" 		=> $user['id_user'],
			"created_at"	=> time(),
			"note"		=> htmlspecialchars($_POST['note']),
			"id_post"		=> $_POST['id_post'],
			"id_bank"		=> $_POST['id_bank'],
			"amount"		=> $_POST['amount']
		);
			$insert = $this->datagood->insertConfirm($data);
			
	}
		

				$uri  = 'https://mandrillapp.com/api/1.0/messages/send.json';	
				$user_first_name = $this->datauser->getAuthorName($item->author);
				$user_email = $this->datauser->getUserEmail($item->author);

				$from_name =$this->datauser->getAuthorName($user['id_user']);
				$link = base_url().$this->router->fetch_class()."/post/".$item->url_post;
				$html = "<p>Hi!</p><p>You have a paymet confirmation from ".$from_name." on your post";		
				$postString = '{
					"key": "'.$this->config->item('mandrill_key').'",
					"message": {    
						"html": "'.$html.'",    
						"subject": "New Comment on Your Post - ichibanlist.com",    
						"from_email": "'.$this->config->item('site_email_sender_addresss').'",    
						"from_name": "'.$this->config->item('site_email_sender').'",    
						"to": [        
							{           
								"email": "'.$user_email.'",           
								"name": "'.$user_first_name.'"        
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
				
				$notif = array(
					"time_notif"	=> time(),
					"from"			=> $user['id_user'],
					"to"			=> $item->author,
					"content"		=> $from_name." sent you a confirmation payment in '".$item->title."' on".date("Y-m-d",time()),
					"url"			=> base_url().$this->router->fetch_class()."/post/".$item->url_post
				);
				
				$this->datagood->createNotif($notif);

$this->session->set_flashdata("message",array("success","Your confirmation successfully posted."));
				redirect(base_url().$this->router->fetch_class()."/confirm/");

	}
	public function postComment(){
		$this->load->config("setting");
		$user = $this->session->userdata("user");
		$item = $this->datagood->getDetail($_POST['id_post']);
		
		$data = array(
			"author" 		=> $user['id_user'],
			"time_comment"	=> time(),
			"comment"		=> htmlspecialchars($_POST['message']),
			"id_post"		=> $item->id_post
		);	
		
		$rules = array(
			array(
                     'field'   => 'message', 
                     'label'   => 'Comment', 
                     'rules'   => 'required'
                ),
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			if($this->datagood->saveComment($data)){
				
				$uri  = 'https://mandrillapp.com/api/1.0/messages/send.json';	
				$user_first_name = $this->datauser->getAuthorName($item->author);
				$user_email = $this->datauser->getUserEmail($item->author);
				$link = base_url().$this->router->fetch_class()."/post/".$item->url_post;
				$html = "<p>Hi!</p><p>You have a new comment on your post. Please check <a href='$link'>here</a></p><p>== ichibanlist.com ==</p>";		
				$postString = '{
					"key": "'.$this->config->item('mandrill_key').'",
					"message": {    
						"html": "'.$html.'",    
						"subject": "New Comment on Your Post - ichibanlist.com",    
						"from_email": "'.$this->config->item('site_email_sender_addresss').'",    
						"from_name": "'.$this->config->item('site_email_sender').'",    
						"to": [        
							{           
								"email": "'.$user_email.'",           
								"name": "'.$user_first_name.'"        
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
				
				$notif = array(
					"time_notif"	=> time(),
					"from"			=> $user['id_user'],
					"to"			=> $item->author,
					"content"		=> "#name# commented on your post '".$item->title."' on #time#",
					"url"			=> base_url().$this->router->fetch_class()."/post/".$item->url_post
				);
				
				$this->datagood->createNotif($notif);
				
				$this->session->set_flashdata("message",array("success","Your comment successfully posted."));
				redirect(base_url().$this->router->fetch_class()."/post/".$item->url_post);
			}else{
				$this->session->set_flashdata("message",array("success","Failed to post your comment."));
				redirect(base_url().$this->router->fetch_class()."/post/".$item->url_post);
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors())); 
			redirect(base_url().$this->router->fetch_class()."/post/".$item->url_post);
		}
	}
	
	public function index(){
	        $this->load->model("dataforum");
		$this->load->view('content/body',array("content" => "search/search_body"));
	}
	
	public function lists()
	{
		if(isset($_POST['keyword'])){
			$this->session->set_userdata("good_search",$_POST['keyword']);
		}
		$user = $this->session->userdata("user");
		if(!in_array(@$user['level'],array("user","admin"))){
			redirect(base_url());
		}else{  
			$this->load->view('content/body',array("content" => "good/listofgood"));
		}
	}
	
	public function delete(){
		if($_GET['id']){
			if($this->datagood->deletePost($_GET['id'])){
				$this->session->set_flashdata("message",array("success","Data successfully deleted."));
				redirect("good/lists");
			}else{
				$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
				redirect("good/lists");
			}
		}else{
			$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
			redirect("good/lists");
		}
	}

		public function deletebank(){
		if($_GET['id']){
			if($this->datagood->deleteBank($_GET['id'])){
				$this->session->set_flashdata("message",array("success","Data successfully deleted."));
				redirect("good/bank");
			}else{
				$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
				redirect("good/bank");
			}
		}else{
			$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
			redirect("good/bank");
		}
	}
	
	public function add(){
		$user = $this->session->userdata("user");
		if(!in_array(@$user['level'],array("user","admin"))){
			redirect(base_url());
			break;
		}else{
			$this->load->view('content/body',array("content" => "good/add"));
		}
	}
	public function addbank(){
		$user = $this->session->userdata("user");
		if(!in_array(@$user['level'],array("user","admin"))){
			redirect(base_url());
			break;
		}else{
			$this->load->view('content/body',array("content" => "bank/add"));
		}
	}

	public function addbankprocess(){
	$user = $this->session->userdata("user");
	$data_mes = array(
			"id_user"			=> $user['id_user'],
			"id_bank"			=> $_POST['id_bank'],
			"name_account"		=> $_POST['account_name'],
			"number_bank"		=> $_POST['number_bank'],
			"location_bank"		=>$_POST['location'],
			"status"			=>$_POST['status'],
		);
        $this->datagood->insertbank($data_mes);
        redirect(base_url("good/bank/"));
	}
	public function edit(){
		$this->load->view('content/body',array("content" => "good/edit"));
	}

	public function editbank(){
			$user = $this->session->userdata("user");
			if(!in_array(@$user['level'],array("user"))){
			redirect(base_url());
			break;
		}else{
		$this->load->view('content/body',array("content" => "bank/edit"));
		}
		
	}

	public function updatebankprocess(){
			$user = $this->session->userdata("user");
	$data_mes = array(
			"id_detailbank"		=> $_POST['id_detbank'],
			"id_user"			=> $user['id_user'],
			"id_bank"			=> $_POST['id_bank'],
			"name_account"		=> $_POST['account_name'],
			"number_bank"		=> $_POST['number_bank'],
			"location_bank"		=>$_POST['location'],
			"status"			=>$_POST['status'],
		);
	$editbank = $this->datagood->updatebank($data_mes);
	if ($editbank) {
		$this->session->set_flashdata("message",array("success","Your post successfully updated."));
				redirect(base_url("good/bank/"));
	}
	}
	
	public function uploadPhoto(){
		// print json_encode($_FILES['filePhoto']);
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
			
			$value = array(
				"path"				=> $path,
				"thumbnail_path"	=> $config['new_image'],
				"time_upload"		=> time(),
				"description"		=> $_POST['photo_description'],
			);
			$insert = $this->datagood->insertData($value);
			
			$data = array(
				"path"	=> $config['new_image'],
				"id"	=> $insert
			);
			print(json_encode($data));
		}
		
		exit;
	}
	
	public function addProcess(){
		$user = $this->session->userdata("user");
		$data = array(
			"url_post"			=> $_POST['url_post'],
			"title"				=> $_POST['title'],
			"tags"				=> $_POST['tags'],
			"content"			=> $_POST['content'],
			"id_location"		=> $_POST['id_location'],
			"id_category"		=> $_POST['id_category'],
			"post_type"			=> "item",
			"post_time"			=> time(),
			"author"			=> $user['id_user'],
			"post_status"		=> "active",
			"amount"			=> $_POST['amount'],
			"viewer"			=> 0,
			"post_update_time"	=> time(),
			"id_video"			=> $_POST['id_video'],
			"video_thumbnail"	=> $_POST['video_thumbnail'],
			
		);
		
		$rules = array(
			array(
                     'field'   => 'title', 
                     'label'   => 'Title', 
                     'rules'   => 'required'
                ),
			// array(
                     // 'field'   => 'author', 
                     // 'label'   => 'User Login', 
                     // 'rules'   => 'required'
                // ),
			array(
                     'field'   => 'content', 
                     'label'   => 'Content', 
                     'rules'   => 'required'
                )
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			$photoadd = explode(";",$_POST['uploadphoto']);
			$photodel = explode(";",$_POST['deletephoto']);
			$pdeleted = array();
			$photoUploaded = array();
			
			if(count($photodel)>0){
				foreach($photodel as $key2=>$val2){
					if($val2!=0){
						$pdeleted[] = $val2;
					}
				}
			}
			if(count($photoadd)>0){
				foreach($photoadd as $key=>$val){
					if($val!=0){
						if(!in_array($val,$pdeleted)){
							$photoUploaded[] = $val;
						}
					}
				}
			}
			
			$insertPost = $this->datagood->insertPost($data);
			if($insertPost){
				if(count($photoUploaded)>0){
					foreach($photoUploaded as $key=>$val){
						$dataphoto = array(
							"id_post"	=> $insertPost,
							"id_photo"	=> $val
						);
						$this->datagood->updatePhotoPost($dataphoto);
					}
				}
				$this->session->set_flashdata("message",array("success","Your post successfully uploaded."));
				redirect(base_url("good/lists/"));
			}else{
				$this->session->set_flashdata("message",array("danger","Error while saving data! Please try again."));
				redirect(base_url("good/lists/"));
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("good/add/"));
		}
	}
	
	public function editProcess(){
		$user = $this->session->userdata("user");
		$data = array(
			"id_post"			=> $_POST['id_post'],
			"url_post"			=> $_POST['url_post'],
			"title"				=> $_POST['title'],
			"tags"				=> $_POST['tags'],
			"content"			=> $_POST['content'],
			"id_location"		=> $_POST['id_location'],
			"id_category"		=> $_POST['id_category'],
			"author"			=> $user['id_user'],
			"amount"			=> $_POST['amount'],
			"post_update_time"	=> time(),
			"id_video"			=> $_POST['id_video'],
			"video_thumbnail"	=> $_POST['video_thumbnail'],
		);
		
		$rules = array(
			array(
                     'field'   => 'title', 
                     'label'   => 'Title', 
                     'rules'   => 'required'
                ),
			// array(
                     // 'field'   => 'author', 
                     // 'label'   => 'User Login', 
                     // 'rules'   => 'required'
                // ),
			array(
                     'field'   => 'content', 
                     'label'   => 'Content', 
                     'rules'   => 'required'
                )
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() != FALSE){
			$photoadd = explode(";",$_POST['uploadphoto']);
			$photodel = explode(";",$_POST['deletephoto']);
			$pdeleted = array();
			$photoUploaded = array();
			
			if(count($photodel)>0){
				foreach($photodel as $key2=>$val2){
					if($val2!=0){
						$pdeleted[] = $val2;
					}
				}
			}
			if(count($photoadd)>0){
				foreach($photoadd as $key=>$val){
					if($val!=0){
						if(!in_array($val,$pdeleted)){
							$photoUploaded[] = $val;
						}
					}
				}
			}
			
			$editPost = $this->datagood->editPost($data);
			if($editPost){
				if(count($photoUploaded)>0){
					$this->datagood->deletePhotoLink($data['id_post']);
					foreach($photoUploaded as $key=>$val){
						$dataphoto = array(
							"id_post"	=> $data['id_post'],
							"id_photo"	=> $val
						);
						$this->datagood->updatePhotoPost($dataphoto);
					}
				}
				$this->session->set_flashdata("message",array("success","Your post successfully updated."));
				redirect(base_url("good/lists/"));
			}else{
				$this->session->set_flashdata("message",array("danger","Error while saving data! Please try again."));
				redirect(base_url("good/edit/?id=".$data['id_post']));
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("good/edit/?id=".$data['id_post']));
		}
	}
}