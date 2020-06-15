<?php defined('BASEPATH') OR exit('No direct script access allowed');
 date_default_timezone_set('Asia/Jakarta');

class HistoryHargaBarang_model extends CI_Model
{

    private $_table="history_harga";

    public $id_history;
    public $id_barang;
    public $status_aktif;
    public $last_update;
    public $harga_penetapan; 
    public $approve;

    public function rules()
    {
        return [
            ['field' => 'harga_penetapan',
            'label' => 'harga_penetapan',
            'rules' => 'required'],
        ];
    }

    public function getBarangApproved($where){
        return $this->db->get_where($this->_table,$where)->result();
        // return $this->db->get_where($this->_table, $where)->result();
    }
    public function get_count_history_price($id){
        $this->db->select("count(id_barang) as count");
        $this->db->where("id_barang", $id);
        $this->db->from($this->_table);
        $query=$this->db->get()->row()->count;
        return $query;
    }
    public function get_current_page_records_history($limit,$start,$where){
        $this->db->limit($limit,$start);
        $query = $this->db->order_by('last_update','desc')->get_where($this->_table,$where);
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    // checkHarga
    public function save()
    {
        // department
        $post = $this->input->post();
     
        $this->id_barang =  $post["nama"];
        $this->status_aktif = "aktif";
        $this->last_update = date('Y-m-d H:i:s');
        $this->harga_penetapan = $post["harga_penetapan"];
        $this->approve = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function unapproveHarga($data)
    {
        extract($data);
        $this->db->where('id_barang',$id_barang);
        $this->db->update($this->_table, array('approve' => $approve));
        return true;
    }

    public function savePertama()
    {
        // department
        $post = $this->input->post();
        $this->id_barang = $_SESSION["idBarang1"];
        $this->status_aktif = "aktif";
        $this->last_update = date('Y-m-d H:i:s');
        $this->harga_penetapan = $post["harga_penetapan"];
        $this->approve = 0;
        return $this->db->insert($this->_table, $this);
    }

    public function approveHarga($data)
    {
        extract($data);
        $this->db->where
        ('`last_update` IN(SELECT max(`last_update`) from `daftar_barang`)',NULL,FALSE);
        $this->db->update($this->_table, array('approve' => $approve));
        return true;
    }
    
}