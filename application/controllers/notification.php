<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model(array("datanotification","datauser"));
		$this->load->library("pagination");
	}
	
	public function index()
	{
		$this->load->view('content/body',array("content" => "notification/index"));
	}
	
	public function openNotif(){
		$id_notif 	= $_POST['id_notif'];
		$notif 		= $this->datanotification->openNotif($id_notif);
		if($notif){
			$url = $this->datanotification->getNotifUrl($id_notif);
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
}