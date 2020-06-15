<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen_model extends CI_Model
{

    private $_table="department";

    public $kode_departemen;
    public $nama_departemen;
 
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
            
            ['field' => 'project',
            'label' => 'project',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
}