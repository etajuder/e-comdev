<?php
class Pertanyaanmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getlistdata($page=1,$kalian,$carian="")
    {
		if($page==""){$page=1;}
		$this->db->like("isi_pertanyaan",$carian);
		$this->db->order_by("kode_pertanyaan","DESC");
		$data = $this->db->get("tb_pertanyaan",$kalian,($page-1)*$kalian);
		return $data->result();
    }
	
	public function getlistkotakota()
    {
		$data = $this->db->query("SELECT * FROM tb_operator");
		return $data->result();
    }
	
	public function getlistpilihan($id)
    {
		$data = $this->db->query("SELECT * FROM tb_pilihan_jawaban WHERE kode_pertanyaan='$id'");
		return $data->result();
    }
	
	public function getTogalPengguna($kode_operator)
    {
		$data = $this->db->query("SELECT COUNT(no_hp) tot FROM tb_pendengar WHERE kode_operator = '$kode_operator'");
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
		$this->db->like("nama_operator",$carian);
		$this->db->from('tb_operator');
		return $this->db->count_all_results();
    }
	
	public function getdetail($id)
    {
		$this->db->where("kode_pertanyaan",$id);
		$data = $this->db->get("tb_pertanyaan");
		$data = $data->result();
		return $data[0];
    }
	
	public function cekSingkatan($kode)
    {
		$this->db->where("kode_operator",$kode);
		$data = $this->db->get("tb_operator");
		if($data->num_rows>0){
			return TRUE;
		}else{
			return FALSE;
		}
    }

    function insertdata($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_pertanyaan', $this->data);
		return $this->db->query($query);
    }

	function insertdatapilihan($data)
    {
        $this->data = $data;
		$query = $this->db->insert_string('tb_pilihan_jawaban', $this->data);
		return $this->db->query($query);
    }
	
	function updatedata($data,$kode)
    {
        $this->data = $data;
		$query = $this->db->update_string('tb_pertanyaan', $this->data,"kode_pertanyaan = '$kode'");
		return $this->db->query($query);
    }
	
	function activatePilihan($kode_pilihan_jawaban)
    {
        $this->data = array(
			"status_pilihan"	=> "aktif"
		);
		$query = $this->db->update_string('tb_pilihan_jawaban', $this->data,"kode_pilihan_jawaban = '$kode_pilihan_jawaban'");
		return $this->db->query($query);
    }
	
	function hapusdata($id)
    {
		$query = "DELETE FROM tb_operator WHERE kode_operator = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }
	
	function hapusdatajawaban($id)
    {
		$query = "DELETE FROM tb_pilihan_jawaban WHERE kode_pilihan_jawaban = '$id'";
		$this->db->query($query);
		return $this->db->affected_rows();
    }

}

?>