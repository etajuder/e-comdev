<?php
class Datalocation extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getHotLocation($str,$limit){
		$this->db->order_by("viewer","DESC");
		$result = $this->db->get("tb_location",$limit,$str);
		return $result->result();
	}
	
	public function plusOneViewer($id_location){
		$result = $this->db->query("UPDATE tb_location SET viewer = viewer + 1 WHERE id_location = '$id_location'");
		return $result;
	}
}
?>