<?php
class Dataitem extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getHotItem($str,$limit){
		$this->db->order_by("viewer","DESC");
		$result = $this->db->get("tb_item",$limit,$str);
		return $result->result();
	}
	
	public function plusOneViewer($id_item){
		$result = $this->db->query("UPDATE tb_item SET viewer = viewer + 1 WHERE id_item = '$id_item'");
		return $result;
	}
}
?>