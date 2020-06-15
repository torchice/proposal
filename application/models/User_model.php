<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    private $_table="user";

    public $id;
    public $password;
    public $nama;
    public $jabatan; 

    public function rules()
    {
      
    }

    public function get_jabatan($table,$where){
        return $this->db->get_where($table,$where);
    }
    
}