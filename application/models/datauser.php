<?php
class Datauser extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        
    }

	public function get_rating($id_user){
          
	}

	public function getAuthorName($id_user){
		$this->db->where("id_user",$id_user);
		$data = $this->db->get("tb_user");
		$data = $data->result();
		return $data[0]->first_name;
	}
	
	public function getUserAvatar($id_user){
		$this->db->where("id_user",$id_user);
		$data = $this->db->get("tb_user");
		$data = $data->result();
		return $data[0]->avatar;
	}
	
	public function getUserEmail($id_user){
		$this->db->where("id_user",$id_user);
		$data = $this->db->get("tb_user");
		$data = $data->result();
		return $data[0]->email;
	}
	
	public function getDetailUser($id_user){
		$this->db->where("id_user",$id_user);
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			$result = $data->result();
			return $result[0];
		}else{
			return 0;
		}
	}
	
	public function createMessage($data)
    {
		$this->db->where("(`user_st` = '".$data['user_st']."' AND `user_nd` = '".$data['user_nd']."') OR (`user_st` = '".$data['user_nd']."' AND `user_nd` = '".$data['user_st']."')");
		$check = $this->db->get("tb_conversation");
		if($check->num_rows()>0){
			$check = $check->result();
			return $check[0]->id_conversation;
		}else{
			$query = $this->db->insert_string("tb_conversation",$data);
			$result = $this->db->query($query);
			return $result;
		}
    }
	
	public function createUser($data)
    {
		$query = $this->db->insert_string("tb_user",$data);
		$result = $this->db->query($query);
		return $result;
    }
	
    public function getUserLoginByOpenID($data,$field_id)
    {
        $this->db->where($field_id,$data);
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return 0;
		}
    }
	
	public function getUserLogin($data)
    {
        $this->db->where("email",$data['email']);
        $this->db->where("password",md5($data['password']));
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return 0;
		}
    }
	
	public function cekUserExistByOpenID($social_id,$social_type){
		$this->db->where($social_type,$social_id);
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function getDetailUserByEmail($email){
		$this->db->where("email",$email);
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return false;
		}
	}
	
	public function getListLocation()
    {
		$this->db->order_by("name_location","ASC");
		$data = $this->db->get("tb_location");
		return $data->result();
    }
	
	public function cekEmailExist($email){
		$this->db->where("email",$email);
		$data = $this->db->get("tb_user");
		if($data->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function updateProfile($data){
		$query = $this->db->update_string("tb_user",$data,"id_user = '".$data['id_user']."'");
		return $this->db->query($query);
	}

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}

?>