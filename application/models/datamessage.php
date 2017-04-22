<?php
class Datamessage extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getHotLocation($str,$limit){
		$this->db->order_by("viewer","DESC");
		$result = $this->db->get("tb_location",$limit,$str);
		return $result->result();
	}
	
	public function getListConversation($id_user){
		$this->db->where("(`user_st` = '$id_user' OR `user_nd` = '$id_user')");
		$this->db->order_by("time_update","DESC");
		$data = $this->db->get("tb_conversation");
		return $data->result();
	}
	
	public function openNotif($id_notif){
		return $this->db->query("UPDATE tb_notification SET open = 1 WHERE id_notification = '$id_notif'");
	}
	
	public function getListMessage($id_conversation){
		$this->db->where("id_conversation",$id_conversation);
		$this->db->order_by("time_created","DESC");
		$data = $this->db->get("tb_message");
		return $data->result();
	}
	
	public function cekIsUserAuth($id_conversation,$id_user){
		$data = $this->db->query("SELECT * FROM tb_conversation WHERE id_conversation = '$id_conversation' AND (user_st = '$id_user' OR user_nd = '$id_user')");
		return $data->num_rows();
	}
	
	public function getConversationOwner($id_conversation){
		$this->db->where("id_conversation",$id_conversation);
		$data = $this->db->get("tb_conversation");
		$data = $data->result();
		return $data[0];
	}
	
	public function getLastMessage($id_conversation){
		$this->db->where("id_conversation",$id_conversation);
		$this->db->order_by("time_created","DESC");
		$data = $this->db->get("tb_message",1,0);
		if($data->num_rows()>0){
			$data = $data->result();
			return $data[0];
		}else{
			return 0;
		}
	}
	
	public function countUnreadMsg($id_conversation,$id_user){
		$this->db->where("id_conversation",$id_conversation);
		$this->db->where("open","0");
		$this->db->where_not_in("author",$id_user);
		$data = $this->db->get("tb_message");
		if($data->num_rows()>0){
			if($data->num_rows()>1){
				return "<span class='orange'>".$data->num_rows()." unread messages</span>";
			}else{
				return "<span class='orange'>".$data->num_rows()." unread message</span>";
			}
		}else{
			return "";
		}
	}
	
	public function saveMessage($data){
		$this->db->query("UPDATE tb_conversation SET time_update = '".time()."' WHERE id_conversation = '".$data['id_conversation']."'");
		$data = $this->db->insert("tb_message",$data);
		return $data;
	}
	
	public function createNotif($data){
		$data = $this->db->insert("tb_notification",$data);
		return $data;
	}
	
	public function readAllMessages($id_conversation,$id_user){
		return $this->db->query("UPDATE tb_message SET open = '1' WHERE id_conversation = '$id_conversation' AND author NOT IN ('$id_user')");
	}
}
?>