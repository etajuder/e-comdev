<?php
class Kotamodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getlistdata($page=1,$kalian,$carian="")
    {
		if($page==""){$page=1;}
		$this->db->like("nama_kota",$carian);
		$data = $this->db->get("tb_kota",$kalian,($page-1)*$kalian);
		return $data->result();
    }

	public function getlistkota()
    {
		$data = $this->db->get("tb_kota");
		if($this->db->affected_rows()>0){
			foreach($data->result() as $key=>$val){
				$hasil[$val->kode_kota] = $val->nama_kota;
			}
		}
		return $hasil;
    }
	
	public function getlistkotakota()
    {
		$data = $this->db->query("SELECT * FROM tb_kota");
		return $data->result();
    }
	
	public function getTotalPengguna($kode_kota)
    {
		$data = $this->db->query("SELECT COUNT(no_hp) tot FROM tb_pendengar,tb_kecamatan WHERE tb_pendengar.kode_kecamatan = tb_kecamatan.kode_kecamatan AND kode_kota = '$kode_kota'");
		$data =  $data->result();
		return $data[0]->tot;
    }
	
	public function getTotalKec($kode_kota)
    {
		$data = $this->db->query("SELECT COUNT(kode_kecamatan) tot FROM tb_kecamatan WHERE kode_kota = '$kode_kota'");
		$data =  $data->result();
		return $data[0]->tot;
    }
	
	
	public function countData($carian="")
    {
		$this->db->like("nama_kota",$carian);
		$this->db->from('tb_kota');
		return $this->db->count_all_results();
    }
	
	public function getdetail($id)
    {
		$this->db->where("kode_kota",$id);
		$data = $this->db->get("tb_kota");
		$data = $data->result();
		return $data[0];
    }
	
	public function cekNomorHP($no_hp)
    {
		$this->db->where("no_hp",$no_hp);
		$data = $this->db->get("tb_kota");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }

    function insertdata($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_kota', $this->data);
		return $this->db->query($query);
    }
	
	function updatedata($data,$kode_kota)
    {
        $this->data = $data;
		$query = $this->db->update_string('tb_kota', $this->data,"kode_kota = $kode_kota");
		return $this->db->query($query);
    }
	
	function hapusdata($id)
    {
		$query = "DELETE FROM tb_kota WHERE kode_kota = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

}

?>