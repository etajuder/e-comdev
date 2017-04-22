<?php
class Datathread extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getLocation($id_location){
		$this->db->where("id_location",$id_location);
		$result = $this->db->get("tb_location");
		$result = $result->result();
		return $result[0]->name_location;
	}
	
	public function getListCategories()
    {
		$this->db->order_by("name_thread","ASC");
		$data = $this->db->get("tb_thread");
		return $data->result();
    }
	
}

?>