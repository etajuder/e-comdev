<?php
class Datacategory extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getHotJobCategory($str,$limit){
		$this->db->order_by("viewer","DESC");
		$result = $this->db->get("tb_job",$limit,$str);
		return $result->result();
	}
	
	public function plusOneViewer($id_job){
		$result = $this->db->query("UPDATE tb_job SET viewer = viewer + 1 WHERE id_job = '$id_job'");
		return $result;
	}
}
?>