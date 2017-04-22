<?php
class Smsmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        
    }

    public function getUserLogin()
    {
        $this->db->where("username",$_POST['username']);
        $this->db->where("password",md5($_POST['password']));
		$data = $this->db->get("tb_administrasi");
		if($data->num_rows()>0){
			return $data->result();
		}else{
			return 0;
		}
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