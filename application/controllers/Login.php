<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model("Proposal_model");
        $this->load->model("DaftarBarang_model");
        // $this->load->library('form_validation');
        $this->load->model("User_model");
    }

    public function index()
    {
        // $data["Proposal"] = $this->Proposal_model->getAll();
        // // $data["Nomer"] = $this->
        // $data['Departemen'] = $this->Departemen_model->getAll();
        $this->load->view("Login");
    }

    public function loginCheck(){
        $username = $this->input->post('Username');
		$password = $this->input->post('Password');
		$where = array(
			'username' => $username,
			'password' => $password
			);
		$cek = $this->User_model->get_jabatan("user",$where)->num_rows();
		if($cek > 0){
            $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
			$data_session = array(
				'nama' => $username,
                'status' => "login",
                'jabatan' => $jabatan
                );
            $data["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
            $data["rejected"]=$this->DaftarBarang_model->get_total_rejected();
            $this->session->set_userdata($data_session);
            if($jabatan=="IT"){
                $this->load->view("Menu",$data);
            }elseif($jabatan=="KARYAWAN"){
                $this->load->view("MenuKaryawan");
            }elseif($jabatan=="ADMIN"){
                $this->load->view("MenuAdmin");
            }
           
            // public function get_jabatan($table,$where){
            //     return $this->db->get_where($table,$where);
            // }
		}else{
            // echo "Username dan password salah !";
            $data["error"]="Whoops! We didn't recognise your username or password. Please try again.";
            $this->load->view("Login",$data);
        }
        
    }
    function logout(){
		$this->session->sess_destroy();
        $this->load->view("Login");
	}


}

?>