<?php
class Databid extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getListUser()
    {
		$this->db->order_by("first_name","ASC");
		$data = $this->db->get("tb_user");
		return $data->result();
    }

	public function getNewList($limit){
		$this->db->order_by("post_time","DESC");
		$result = $this->db->get("tb_bid", $limit, 0);
		return $result->result();
	}
    
    public function getListOfdata($page=1,$kalian,$id_user,$id_post = null)
    {
		if($page==""){$page=1;}

		if($id_user!=0){
			$this->db->where("tb_post.author",$id_user);
		}
		$this->db->where("tb_bid.id_post",$id_post);
		$this->db->join('tb_post', 'tb_post.id_post = tb_bid.id_post');
		$this->db->order_by("create_at","DESC");
		$data = $this->db->get("tb_bid",$kalian,($page-1)*$kalian);
		
		return $data->result();
    }
	
	public function getListOfdataNoLimit($data = null){
		$result = $this->db->get("tb_bid");
		return $result->num_rows();
	}
	
	public function countData($carian="")
    {
		$this->db->from('tb_bid');
		return $this->db->count_all_results();
    }
	

    function insertBid($data)
    {
        $query = $this->db->insert_string("tb_bid",$data);
		if($this->db->query($query)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
    }

    public function editBid($data)
    {
		$query = $this->db->update_string("tb_bid",$data, "id_bid = '".$data['id_bid']."'");
		return $this->db->query($query);
    }

    function delete($id, $id_post)
    {
		$query = "DELETE FROM tb_bid WHERE id_bid = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

    public function maxBid($id_post){
    	$this->db->select_max('price_bid', 'max_bid');
    	$this->db->where('id_post', $id_post);
    	$this->db->where('state', 'accept');
    	$result = $this->db->get("tb_bid");
		return $result->row();
    }

}

?>