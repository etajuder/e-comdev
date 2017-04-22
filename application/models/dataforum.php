<?php
class Dataforum extends CI_Model {

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
	
	public function getCategoryName($id_category){
		$this->db->where("id_thread",$id_category);
		$result = $this->db->get("tb_thread");
		$result = $result->result();
		return $result[0]->name_thread;
	}
	
    public function getListOfdata($page=1,$kalian,$id_user,$data = null)
    {
		if($page==""){$page=1;}
		if(count($data['keyword'])>0){
			$keys = 0;
			foreach($data['keyword'] as $key=>$val){
				if($keys==0){
					$where_like = "title LIKE '%$val%'";
					$keys++;
				}else{
					$where_like = $where_like." OR title LIKE '%$val%'";
					$keys++;
				}
			}
		}
		$this->db->where("( $where_like )");
		if(@$data['id_category'] != ""){
			$this->db->where("id_category",$data['id_category']);
		}
		if($id_user!=0){
			$this->db->where("author",$id_user);
		}
		$this->db->where("post_status","active");
		$this->db->where("post_type","thread");
		$this->db->order_by("post_update_time","DESC");
		$data = $this->db->get("tb_post",$kalian,($page-1)*$kalian);
		return $data->result();
    }
	
	public function getListOfdataNoLimit($data = null){
		if(count($data['keyword'])>0){
			$keys = 0;
			foreach($data['keyword'] as $key=>$val){
				if($keys==0){
					$where_like = "title LIKE '%$val%'";
					$keys++;
				}else{
					$where_like = $where_like." OR title LIKE '%$val%'";
					$keys++;
				}
			}
		}
		$this->db->where("( $where_like )");
		if(@$data['id_location'] != ""){
			$this->db->where("id_location",$data['id_location']);
		}
		if(@$data['id_category'] != ""){
			$this->db->where("id_category",$data['id_category']);
		}
		$this->db->where("post_status","active");
		$this->db->where("post_type","thread");
		$result = $this->db->get("tb_post");
		return $result->num_rows();
	}
	
	public function getOneURLPhoto($id_post){
		$this->db->where("id_post",$id_post);
		$this->db->limit(1,0);
		$this->db->order_by("time_upload","DESC");
		$data = $this->db->get("tb_photo");
		$data = $data->result();
		return $data[0];
	}
	
	public function countData($carian="")
    {
		$this->db->like("title",$carian);
		$this->db->where("post_type","thread");
		$this->db->where("post_status","active");
		$this->db->from('tb_post');
		return $this->db->count_all_results();
    }
	
	public function insertData($data)
    {
		$query = $this->db->insert_string("tb_photo",$data);
		$this->db->query($query);
		return $this->db->insert_id();
    }
	
	public function getListThread()
    {
		$this->db->order_by("name_thread","ASC");
		$data = $this->db->get("tb_thread");
		return $data->result();
    }
	
	public function getListLocation()
    {
		$this->db->order_by("name_location","ASC");
		$data = $this->db->get("tb_location");
		return $data->result();
    }
	
	public function updatePhotoPost($data)
    {
		$query = $this->db->update_string("tb_photo",$data, "id_photo = '".$data['id_photo']."'");
		return $this->db->query($query);
    }
	
	public function editPost($data)
    {
		$query = $this->db->update_string("tb_post",$data, "id_post = '".$data['id_post']."'");
		return $this->db->query($query);
    }
	
	function insertPost($data)
    {
        $query = $this->db->insert_string("tb_post",$data);
		if($this->db->query($query)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
    }
	
	function getTotalPhoto($id_post){
		$this->db->where("id_post",$id_post);
		$query = $this->db->get("tb_photo");
		return $query->num_rows();
	}
	
	function getDetail($id_post){
		$this->db->where("id_post",$id_post);
		$query 	= $this->db->get("tb_post");
		$result = $query->result();
		return $result[0];
	}
	function getDetailByURL($url_post){
		$this->db->where("url_post",$url_post);
		$query 	= $this->db->get("tb_post");
		$result = $query->result();
		return $result[0];
	}
	public function getRelatedPost($id_category,$post_type)
    {
		$this->db->where("id_category",$id_category);
		$this->db->where("post_type",$post_type);
		$this->db->order_by("post_time","RAND()");
		$this->db->limit(6,0);
		$data = $this->db->get("tb_post");
		return $data->result();
    }
	public function saveComment($data){
		$query = $this->db->insert_string("tb_comment",$data);
		$result = $this->db->query($query);
		return $result;
	}
	
	public function createNotif($data){
		$query = $this->db->insert_string("tb_notification",$data);
		$result = $this->db->query($query);
		return $result;
	}
	
	public function getListComment($id_post){
		$this->db->where("id_post", $id_post);
		$this->db->order_by("time_comment", "DESC");
		$data = $this->db->get("tb_comment");
		return $data->result();
	}
	public function plusOneViewer($id_post){
		$result = $this->db->query("UPDATE tb_post SET viewer = viewer + 1 WHERE id_post = '$id_post'");
		return $result;
	}
	function getListPhotoOfPost($id_post){
		$this->db->where("id_post",$id_post);
		$query 	= $this->db->get("tb_photo");
		return $query->result();
	}
	
	function deletePhotoLink($id_post)
    {
		$query = "UPDATE tb_photo SET id_post = '' WHERE id_post = '$id_post'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }
	
	function deletePost($id)
    {
		$query = "UPDATE tb_post SET post_status = 'inactive' WHERE id_post = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

	function getListHotThreads(){
		$query 	= $this->db->query("SELECT * FROM tb_post WHERE post_type = 'thread' ORDER BY viewer DESC LIMIT 0,6 ");
		return $query->result();
	}	
	
}

?>