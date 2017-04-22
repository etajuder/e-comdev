<?php
class Kecamatanmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getlistdata($page=1,$kalian,$carian="")
    {
		if($page==""){$page=1;}
		$this->db->like("nama_kecamatan",$carian);
		$data = $this->db->get("tb_kecamatan",$kalian,($page-1)*$kalian);
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
	
	public function getTotalPengguna($kode_kecamatan)
    {
		$data = $this->db->query("SELECT COUNT(kode_kecamatan) tot FROM tb_pendengar WHERE kode_kecamatan = '$kode_kecamatan'");
		$data =  $data->result();
		return $data[0]->tot;
    }
	
	
	public function countData($carian="")
    {
		$this->db->like("nama_kecamatan",$carian);
		$this->db->from('tb_kecamatan');
		return $this->db->count_all_results();
    }
	
	public function getdetail($id)
    {
		$this->db->where("kode_kecamatan",$id);
		$data = $this->db->get("tb_kecamatan");
		$data = $data->result();
		return $data[0];
    }
	
	public function cekNomorHP($no_hp)
    {
		$this->db->where("no_hp",$no_hp);
		$data = $this->db->get("tb_kecamatan");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }

    function insertdata($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_kecamatan', $this->data);
		return $this->db->query($query);
    }
	
	function updatedata($data,$kode_kecamatan)
    {
        $this->data = $data;
		$query = $this->db->update_string('tb_kecamatan', $this->data,"kode_kecamatan = $kode_kecamatan");
		return $this->db->query($query);
    }
	
	function hapusdata($id)
    {
		$query = "DELETE FROM tb_kecamatan WHERE kode_kecamatan = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

}

?>