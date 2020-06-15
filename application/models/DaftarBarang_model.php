<?php defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class DaftarBarang_model extends CI_Model
{

    private $_table="daftar_barang";

    public $id_barang;
    public $kategori_barang;
    // public $nama_barang;
    public $harga_penetapan; 
    public $status_aktif;
    public $approve;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'],

            // ['field' => 'project',
            // 'label' => 'project',
            // 'rules' => 'numeric'],
 
        ];
    }

    public function getBarangApproved($where){
        return $this->db->get_where($this->_table,$where)->result();
        // return $this->db->get_where($this->_table, $where)->result();
    }
    // checkHarga
    public function getHarga($kodeBarang){
        return $this->db->get_where($this->_table, ["id_barang" => $kodeBarang])->row();
    }

    public function get_current_page_records_non_active($limit,$start,$where){
        $this->db->limit($limit,$start);
        $query = $this->db->get_where($this->_table,$where);
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function save()
    {
        // department
        $post = $this->input->post();
        $this->nama_barang =  $post["nama"];
        $this->kategori_barang = $post["department"];
        $this->harga_penetapan = $post["harga_penetapan"];
        $this->status_aktif = "aktif";
        $this->approve = 0;
        $this->last_update =  date('Y-m-d H:i:s');
       
        // $_SESSION["inputBarang"]="available";

        $this->db->insert($this->_table, $this);
        return $this->db->insert_id();
    }

    public function update(){
        $post = $this->input->post();
        $this->id_barang = $post["nama"];
        $this->harga_penetapan = $post["harga_penetapan"];
        $this->last_update = date('Y-m-d H:i:s');
        $this->approve = 0;
        $this->status_aktif = "aktif";
        $this->kategori_barang = $post["department"];
        return $this->db->update($this->_table, $this, array('id_barang' => $post['nama']));
    }
    public function approveHarga($data)
    {
        extract($data);
        $this->db->where('id_barang',$id_barang);
        $this->db->update($this->_table, array('approve' => $approve));
        return true;
    }
    public function rejectHarga($data){
        extract($data);
        $this->db->where('id_barang',$id_barang);
        $this->db->update($this->_table, array('approve' => $approve));
        return true;
    }
    public function getDatabyCategory($where){
        return $query = $this->db->get_where($this->_table,$where)->result();
    }
    public function getHargabyId($where){
        return $query = $this->db->get_where($this->_table,$where)->result();
    }

    public function get_total(){
        $this->db->select("count(kode_proposal) as count");
        $this->db->from($this->_table);
        $query=$this->db->get()->row()->count;
        return $query;
    }
    public function get_total_non_confirmed(){
        $this->db->select("count(id_barang) as count");
        $this->db->from($this->_table);
        $this->db->where("approve", 0);
        $query=$this->db->get()->row()->count;
        return $query;
    }
    public function get_total_rejected(){
        $this->db->select("count(id_barang) as count");
        $this->db->from($this->_table);
        $this->db->where("approve", 2);
        $query=$this->db->get()->row()->count;
        return $query;
    }
    
}