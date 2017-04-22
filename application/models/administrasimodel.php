<?php
class Administrasimodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getlistdata($page=1,$kalian,$carian="")
    {
		if($page==""){$page=1;}
		$this->db->like("nama",$carian);
		$data = $this->db->get("tb_administrasi",$kalian,($page-1)*$kalian);
		return $data->result();
    }
	
	public function countData($carian="")
    {
		$this->db->like("nama",$carian);
		$this->db->from('tb_administrasi');
		return $this->db->count_all_results();
    }
	
	public function getdetail($id)
    {
		$this->db->where("kode_administrasi",$id);
		$data = $this->db->get("tb_administrasi");
		$data = $data->result();
		return $data[0];
    }
	
	public function cekKodeAdmin($kode)
    {
		$this->db->where("kode_administrasi",$kode);
		$data = $this->db->get("tb_administrasi");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }
	
	public function cekUsername($username)
    {
		$this->db->where("username",$username);
		$data = $this->db->get("tb_administrasi");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }

    function insertdata($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_administrasi', $this->data);
		return $this->db->query($query);
    }
	
	function updatedata($data)
    {
        $this->data = $data;
		$query = $this->db->update_string('tb_administrasi', $this->data,"kode_administrasi = ".$this->data['kode_administrasi']);
		return $this->db->query($query);
    }
	
	function hapusdata($id)
    {
		$query = "DELETE FROM tb_administrasi WHERE kode_administrasi = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

}

?>