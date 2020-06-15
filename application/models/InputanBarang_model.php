<?php defined('BASEPATH') OR exit('No direct script access allowed');

class InputanBarang_model extends CI_Model
{

    private $_table="barang_proposal";

    public $kode_barang;
    // public $nomor;
    public $nama;

    public $spesifikasi;
    public $jumlah;
    public $perkiraan_biaya_unit;
    public $total_perkiraan_biaya;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'],

            // ['field' => 'project',
            // 'label' => 'project',
            // 'rules' => 'numeric'],
            
            ['field' => 'jumlah',
            'label' => 'jumlah',
            'rules' => 'required']
        ];
    }
    public function DetailBarang($where){
        return $this->db->get_where($this->_table, $where)->result();
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["nomor_proposal" => $id])->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nomor_proposal = $_SESSION["nomor_proposal"];
        $this->nama = $_SESSION["namaBarang"];
        $this->spesifikasi = $post["spesifikasi"];
        $this->jumlah = $post["jumlah"];
        $this->perkiraan_biaya_unit = $post["inputanHarga"];
        $this->total_perkiraan_biaya = $post["hiddenBiayaTotal"];
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