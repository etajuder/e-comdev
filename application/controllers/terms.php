<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model("datauser");
		$this->load->library("pagination");
	}
	
	public function PrivacyPolicy()
	{
		$this->load->view('content/body',array("content" => "terms/privacy_policy"));
	}
}