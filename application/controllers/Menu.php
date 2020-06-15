<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Proposal_model");
        $this->load->model("Departemen_model");
        // $this->load->model()
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->model('InputanBarang_model');
        $this->load->model('');
        $this->load->model("DaftarBarang_model");
        if ($this->session->userdata['jabatan'] == "")
        {
            //do something
            redirect('Login'); 
        }
    }

    public function index()
    {
        // $data["Proposal"] = $this->Proposal_model->getAll();
        // // $data["Nomer"] = $this->
        // $data['Departemen'] = $this->Departemen_model->getAll();
 
        $params["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
        // // $data["rejected"]=$this->DaftarBarang_model->get_total_rejected();
        $params = array();
        $limit_per_page = 10;
        $where = array(
            'approve'=>  0
        );
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->DaftarBarang_model->get_total_non_confirmed();
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $params["results"]= $this->DaftarBarang_model->get_current_page_records_non_active($limit_per_page, $start_index,$where);
            $config["base_url"] = site_url() . "/Menu/GoKonfirmasiBarang";
            $config["total_rows"] =$this->DaftarBarang_model->get_total_non_confirmed();
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();

        }
        $params["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
        $params["rejected"]=$this->DaftarBarang_model->get_total_rejected();
        $this->load->view("Menu",$params);
    }
    
    public function GoNewBarang(){
        $data['Departemen'] = $this->Departemen_model->getAll();
        
        $this->load->view("InsertNewBarang",$data);
    }
    public function GoChangeHarga(){
        $data['Departemen'] = $this->Departemen_model->getAll();
        $this->load->view("ChangeHarga",$data);
    }
    public function GoHistoryHarga(){
        $data['Departemen'] = $this->Departemen_model->getAll();
        $this->load->view("HistoryHarga",$data);
    }
    public function GoKonfirmasiBarang(){
        $params = array();
        $limit_per_page = 10;
        $where = array(
            'approve'=>  0
        );
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->DaftarBarang_model->get_total_non_confirmed();
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $params["results"]= $this->DaftarBarang_model->get_current_page_records_non_active($limit_per_page, $start_index,$where);
            $config["base_url"] = site_url() . "/Menu/GoKonfirmasiBarang";
            $config["total_rows"] =$this->DaftarBarang_model->get_total_non_confirmed();
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();

        }
        $params["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
      
        $this->load->view("KonfirmasiBarang",$params);
    }


}

?>