<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller {
	function en(){
		$this->session->set_userdata("language","english");
		redirect();
	}
	
	function id(){
		$this->session->set_userdata("language","indonesian");
		redirect();
	}
		function jp(){
		$this->session->set_userdata("language","japanese");
		redirect();
	}
}