<?php 
	error_reporting(0);
	require_once("auth/function.php");
	require_once("auth/configuration.php");
	$con = new Connection();
	$data = array(
		"full_name"	=> $_POST['full_name'],
		"bbid"		=> $_POST['bbid'],
		"email"		=> $_POST['email']
	);
	
	$rules = array(
		"email"		=> array("Email Address", "required|email"),
		"bbid"		=> array("ID BBM", "required")
	);
	
	if(cek_input($data, $rules)){
		if($con->db->sql_insert("tb_registrasi",$data)){
			print json_encode(array("status" => "success"));
		}else{
			print json_encode(array("status" => "error3"));
		}
		exit;
	}else{
		// print_r(show_thread());
		print json_encode(array("status" => "error"));
		exit;
	}
?>