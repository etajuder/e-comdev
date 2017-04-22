<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {
	private $twitterconnection;

	public function __construct(){
		parent::__construct();
		$this->load->model("datauser");
		$this->load->library("pagination");
	}
	
	public function index()
	{
		$this->load->view('content/body',array("content" => "help/index"));
	}
}