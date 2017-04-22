<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hommy extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array("dataforum","datagood","datajob","dataitem","datalocation"));
	}
	public function index()
	{
		$this->load->view('content/body',array("content" => "home/hommy"));
	}
}