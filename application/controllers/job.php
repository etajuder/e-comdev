<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(array("datajob","datauser","datalocation","datacategory", "databid"));
		$this->load->library("pagination");
	}
	
	public function index(){
		$this->load->model("dataforum");
		$this->load->view('content/body',array("content" => "search/search_body"));
	}
	public function post(){
		$this->load->model("dataforum");
		$this->load->view('content/body',array("content" => "detail/detail_body"));
	}
	
	public function postComment(){
		$this->load->config("setting");
		$user = $this->session->userdata("user");
		$item = $this->datajob->getDetail($_POST['id_post']);
		
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
			if($this->datajob->saveComment($data)){
				
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
				
				$this->datajob->createNotif($notif);
				
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
	
	public function lists()
	{
		if(isset($_POST['keyword'])){
			$this->session->set_userdata("job_search",$_POST['keyword']);
		}
		$user = $this->session->userdata("user");
		if(!in_array(@$user['level'],array("user","admin"))){
			redirect(base_url());
		}else{
			$this->load->view('content/body',array("content" => "job/list"));
		}
	}
	
	public function delete(){
		if($_GET['id']){ 
			if($this->datajob->deletePost($_GET['id'])){
				$this->session->set_flashdata("message",array("success","Data successfully deleted."));
				redirect("job/lists");
			}else{
				$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
				redirect("job/lists");
			}
		}else{
			$this->session->set_flashdata("message",array("danger","Oops, can not delete the data."));
			redirect("job/lists");
		}
	}
	
	public function add(){
		$this->load->view('content/body',array("content" => "job/add"));
	}
	
	public function edit(){
		$this->load->view('content/body',array("content" => "job/edit"));
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
			// $result = array('upload_data' => $this->upload->data());
			// $value = array(
				// "path"			=> "assets/uploads/".$result['upload_data']['file_name'],
				// "time_upload"	=> time(),
				// "description"	=> $_POST['photo_description'],
			// );
			// $insert = $this->datajob->insertData($value);
			
			// $data = array(
				// "path"	=> "assets/uploads/".$result['upload_data']['file_name'],
				// "id"	=> $insert
			// );
			// print(json_encode($data));
			
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
			$insert = $this->datajob->insertData($value);
			
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
			"id_video"			=> $_POST['id_video'],
			"video_thumbnail"	=> $_POST['video_thumbnail'],
			"post_type"			=> "job",
			"post_time"			=> time(),
			"author"			=> $user['id_user'],
			"post_status"		=> "active",
			"amount"			=> $_POST['amount'],
			"amount_label"		=> $_POST['amount_label'],
			"viewer"			=> 0,
			"post_update_time"	=> time(),
			"time_open"			=> strtotime($_POST['time_open']),
			"time_close"		=> strtotime($_POST['time_close'])
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
			
			$insertPost = $this->datajob->insertPost($data);
			if($insertPost){
				if(count($photoUploaded)>0){
					foreach($photoUploaded as $key=>$val){
						$dataphoto = array(
							"id_post"	=> $insertPost,
							"id_photo"	=> $val
						);
						$this->datajob->updatePhotoPost($dataphoto);
					}
				}
				$this->session->set_flashdata("message",array("success","Your post successfully uploaded."));
				redirect(base_url("job/lists/"));
			}else{
				$this->session->set_flashdata("message",array("danger","Error while saving data! Please try again."));
				redirect(base_url("job/lists/"));
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("job/add/"));
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
			"amount_label"		=> $_POST['amount_label'],
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
			
			$editPost = $this->datajob->editPost($data);
			if($editPost){
				if(count($photoUploaded)>0){
					$this->datajob->deletePhotoLink($data['id_post']);
					foreach($photoUploaded as $key=>$val){
						$dataphoto = array(
							"id_post"	=> $data['id_post'],
							"id_photo"	=> $val
						);
						$this->datajob->updatePhotoPost($dataphoto);
					}
				}
				$this->session->set_flashdata("message",array("success","Your post successfully updated."));
				redirect(base_url("job/lists/"));
			}else{
				$this->session->set_flashdata("message",array("danger","Error while saving data! Please try again."));
				redirect(base_url("job/edit/?id=".$data['id_post']));
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors()));
			redirect(base_url("job/edit/?id=".$data['id_post']));
		}
	}
}