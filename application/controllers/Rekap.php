<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Proposal_model");
        $this->load->model("Departemen_model");
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->model('InputanBarang_model');
        if ($this->session->userdata['jabatan'] == "")
        {
            //do something
            redirect('Login'); 
        }
    }
    public function Godetail(){
        $kodeId=$_GET["kdpro"];
        $where = array(
            'nomor_proposal' => $kodeId
        );
        $data["results"] = $this->InputanBarang_model->DetailBarang($where);
        $this->load->view("DetailRekap",$data);
    }

    public function index()
    {
        $params = array();
        $limit_per_page = 10;
      
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->Proposal_model->get_total();
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $params["results"]= $this->Proposal_model->get_current_page_records($limit_per_page, $start_index);
            $config["base_url"] = site_url() . "/Rekap/index";
            $config["total_rows"] =$this->Proposal_model->get_total();
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();

        }
      
        $this->load->view("Rekap",$params);
    }

    public function rekap_non_confirmed(){
        $params = array();
        $limit_per_page = 10;
      
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->Proposal_model->get_total();
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            //untuk where activate = 0 yang artinya index untuk angka report yang tidak active
    
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $where = array(
                'konfirmasi' => 1
                );
                // $this->db->select("count(kode_proposal) as count");
                // $this->db->where("konfirmasi", $where["konfirmasi"]);
                // $this->db->from($this->_table);
                // $query=$this->db->get()->row()->count;
                // return $query;
            $params["results"]= $this->Proposal_model->get_current_page_records_non_active($limit_per_page, $start_index, $where);
            $config["base_url"] = site_url() . "/Rekap/index";
            $config["total_rows"] =$this->Proposal_model->get_total_non_confirmed($where);
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();
        }
      
        $this->load->view("Rekap",$params);
    }

    public function generateNomor(){
           //001/VI/15/PROD
        $departemen=$_POST['departemenVal'];
        $tanggal=$_POST['tanggalVal'];
        $data["result"] =  $this->Proposal_model->getDataPerDepartemen($departemen)->count;
        $dateInput= new DateTime($tanggal);
        $formattedMonth = $dateInput->format('n');
        $formattedDate = $dateInput->format('y');
        // $formattedYear = $dateinput->format('y');
        $nomorAkhir = $data["result"]+1;
        if($nomorAkhir<10)
        {
            $nomorAkhir = "00" . strval($nomorAkhir);
        }elseif($nomorAkhir<100)
        {
            $nomorAkhir = "0" . strval($nomorAkhir);
        }
        $result = $this->integerToRoman($formattedMonth);
        $gabungan =$nomorAkhir . "/". $result . "/" . $formattedDate . "/" . $departemen;
        $_SESSION["nomor_proposal"]=$gabungan;
        echo $gabungan;
    }

    public function gotoaddBarang()
    {
        $Proposal = $this->Proposal_model;
        $validation = $this->form_validation;
        $validation->set_rules($Proposal->rules());
        
        if ($validation->run()) {
            $Proposal->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        } 

        $this->load->view("Barang");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/Proposal');
       
        $Proposal = $this->Proposal_model;
        $validation = $this->form_validation;
        $validation->set_rules($Proposal->rules());

        if ($validation->run()) {
            $Proposal->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["Proposal"] = $Proposal->getById($id);

        if (!$data["Proposal"]) show_404();
        
        $this->load->view("admin/Proposal/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Proposal_model->delete($id)) {
            redirect(site_url('admin/Proposal'));
        }
    }
}

?>