<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model(array("datamessage","datauser"));
		$this->load->library("pagination");
	}
	
	public function index()
	{
		$this->load->view('content/body',array("content" => "message/index"));
	}
	
	public function conversation()
	{
		$this->load->view('content/body',array("content" => "message/conversation"));
	}
	
	public function openNotif(){
		$id_notif 	= $_POST['id_notif'];
		$notif 		= $this->datamessage->openNotif($id_notif);
		if($notif){
			$url = $this->datamessage->getNotifUrl($id_notif);
			if($url){
				$result = array(
					"code" 	=> "success",
					"url"	=> $url
				);
			}else{
				$result = array(
					"code" 		=> "error",
					"reason"	=> 2
				);
			}
		}else{
			$result = array(
				"code" 		=> "error",
				"reason"	=> 1
			);
		}
		print json_encode($result);
		exit;
	}
	
	public function sendMessage(){
		$user = $this->session->userdata("user");
		$this->load->config("setting");
		$item = $this->datamessage->getConversationOwner($_POST['id_conversation']);
		if($user['id_user']==$item->user_st){
			$target = $item->user_nd;
		}else{
			$target = $item->user_st;
		}
		
		$data = array(
			"message" 			=> $_POST['message'],
			"id_conversation" 	=> $_POST['id_conversation'],
			"author"			=> $user['id_user'],
			"time_created"		=> time(),
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
			$insert = $this->datamessage->saveMessage($data);
			if($insert){
				$uri  = 'https://mandrillapp.com/api/1.0/messages/send.json';	
				$user_first_name = $this->datauser->getAuthorName($target);
				$user_email = $this->datauser->getUserEmail($target);
				$link = base_url()."message/conversation/".$_POST['id_conversation'];
				$html = "<p>Hi!</p><p>You have a new message. Please check <a href='$link'>here</a></p><p>== ichibanlist.com ==</p>";		
				$postString = '{
					"key": "'.$this->config->item('mandrill_key').'",
					"message": {    
						"html": "'.$html.'",    
						"subject": "New Message - ichibanlist.com",    
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
					"to"			=> $target,
					"content"		=> "#name# send you a new message on #time#",
					"url"			=> $link,
					"type"			=> 1
				);
				$this->datamessage->createNotif($notif);
				$this->session->set_flashdata("message",array("success","Message has been delivered.")); 
				redirect(base_url()."message/conversation/".$_POST['id_conversation']);
			}else{
				$this->session->set_flashdata("message",array("danger","Message can't be delivered!")); 
				redirect(base_url()."message/conversation/".$_POST['id_conversation']);
			}
		}else{
			$this->session->set_flashdata("message",array("danger",validation_errors())); 
			redirect(base_url()."message/conversation/".$_POST['id_conversation']);
		}
	}
}