<?php
class Pendengarmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getlistdata($page=1,$kalian,$carian="")
    {
		if($page==""){$page=1;}
		$this->db->like("nama",$carian);
		$data = $this->db->get("tb_pendengar",$kalian,($page-1)*$kalian);
		return $data->result();
    }

	public function getlistoperator()
    {
		$data = $this->db->get("tb_operator");
		return $data->result();
    }
	
	public function getlistkecamatan()
    {
		$data = $this->db->query("SELECT kode_kecamatan, nama_kota, nama_kecamatan FROM tb_kecamatan,tb_kota WHERE tb_kota.kode_kota = tb_kecamatan.kode_kota");
		return $data->result();
    }
	
	public function countData($carian="")
    {
		$this->db->like("nama",$carian);
		$this->db->from('tb_pendengar');
		return $this->db->count_all_results();
    }
	
	public function getdetail($id)
    {
		$this->db->where("no_hp",$id);
		$data = $this->db->get("tb_pendengar");
		$data = $data->result();
		return $data[0];
    }
	
	public function getkecamatan()
    {
		$data = $this->db->get("tb_kecamatan");
		if($this->db->affected_rows()>0){
			foreach($data->result() as $key=>$val){
				$hasil[$val->kode_kecamatan] = $val->nama_kecamatan;
			}
		}
		return $hasil;
    }
	
	public function getoperator()
    {
		$data = $this->db->get("tb_operator");
		if($this->db->affected_rows()>0){
			foreach($data->result() as $key=>$val){
				$hasil[$val->kode_operator] = $val->nama_operator;
			}
		}
		return $hasil;
    }
	
	public function cekNomorHP($no_hp)
    {
		$this->db->where("no_hp",$no_hp);
		$data = $this->db->get("tb_pendengar");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }

    function insertdata($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_pendengar', $this->data);
		return $this->db->query($query);
    }
	
	function updatedata($data,$no_hp_lama)
    {
        $this->data = $data;
		$query = $this->db->update_string('tb_pendengar', $this->data,"no_hp = $no_hp_lama");
		return $this->db->query($query);
    }
	
	function hapusdata($id)
    {
		$query = "DELETE FROM tb_pendengar WHERE no_hp = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

}

?>