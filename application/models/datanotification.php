<?php
class Datanotification extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	public function getHotLocation($str,$limit){
		$this->db->order_by("viewer","DESC");
		$result = $this->db->get("tb_location",$limit,$str);
		return $result->result();
	}
	
	public function getListNotifications($id_user){
		$this->db->where("to",$id_user);
		$this->db->order_by("time_notif","DESC");
		$data = $this->db->get("tb_notification");
		return $data->result();
	}
	
	public function openNotif($id_notif){
		return $this->db->query("UPDATE tb_notification SET open = 1 WHERE id_notification = '$id_notif'");
	}
	
	public function getNotifUrl($id_notif){
		$this->db->where("id_notification",$id_notif);
		$data = $this->db->get("tb_notification");
		$data = $data->result();
		return $data[0]->url;
	}
}
?>