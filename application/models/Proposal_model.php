<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal_model extends CI_Model
{

    private $_table="info_proposal";

    public $kode_proposal;
    public $jenis;
 
    public $keperluan;
    public $tanggal;
    public $nomor;
    public $department;
    public $pertimbangan;
 
   
    public $keadaan;
    // public $disetujui;
    // public $diketahui;
    public $diajukan;

    // public function index(){
    //     $data['departemen'] = $this->delivery_model->getAllGroups();
    // }

    public function rules()
    {
        return [
            ['field' => 'jenis',
            'label' => 'jenis',
            'rules' => 'required'],

            // ['field' => 'project',
            // 'label' => 'project',
            // 'rules' => 'numeric'],

        ];
    }
//untuk semua records
    public function get_current_page_records($limit,$start){
        $this->db->limit($limit,$start);
        $query = $this->db->get("info_proposal");
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
//untuk yang non active
    public function get_current_page_records_non_active($limit,$start,$where){
        $this->db->limit($limit,$start);
        $query = $this->db->get_where("info_proposal",$where);
        if($query->num_rows() > 0){
            foreach($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function get_total(){
        $this->db->select("count(kode_proposal) as count");
        $this->db->from($this->_table);
        $query=$this->db->get()->row()->count;
        return $query;
    }
    

    public function get_total_non_confirmed($where){
     
        $this->db->select("count(kode_proposal) as count");
        $this->db->where("konfirmasi", $where["konfirmasi"]);
        $this->db->from($this->_table);
        $query=$this->db->get()->row()->count;
        return $query;
    }

    public function specific_proposal($kdpro){
        // $kd=$_GET['kdpro'];
        return $this->db->get_where('info_proposal', ["nomor" => $kdpro])->result();
    }

    public function count_row(){
        $query=$this->db->get("info_proposal");
        return $query->num_rows();
    }
  

    public function getDataPerDepartemen($departemen){
        // select count(kode_proposal) from info_proposal where department='TEKNIK'
        // return $this->db->get_where($this->_table, ["department" => $departemen])->row();
        // query diatas sudah benar jika di vardump, hanya perlu memilih kolom yang akan ditampilkan, contoh ->row()->kode_proposal
        $this->db->select("count(kode_proposal) as count");
        $this->db->from($this->_table);
        $this->db->where('department', $departemen);
        $query=$this->db->get()->row();
        return $query;
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->product_id = uniqid();
        $this->pabrik = $post["pabrik"];
        $this->jenis = $post["jenis"];
    
        $this->keperluan = $post["kepentingan"];
        $this->lokasi =$post["lokasi"];
        $this->tanggal = $post["tanggal"];
        $this->nomor = $_SESSION["nomor_proposal"];
        $this->department = $post["department"];
        $this->pertimbangan = $post["pertimbangan"];
        $this->keadaan = $post["keadaan"];
        // $this->keterangan =$post["keterangan"];
        // $this->disetujui = "Pak Antony";
        // $this->diketahui = "Manajemen PPIC";
        $this->diajukan = $post["diajukan"];
        $_SESSION["inputBarang"]="available";
    
        // $this->description = $post["description"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->product_id = $post["id"];
        $this->name = $post["name"];
        $this->price = $post["price"];
        $this->description = $post["description"];
        return $this->db->update($this->_table, $this, array('product_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("product_id" => $id));
    }
}