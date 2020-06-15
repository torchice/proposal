<!-- get_count_history_price -->
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("HistoryHargaBarang_model");
        $this->load->library('form_validation');
        $this->load->model("DaftarBarang_model");
        $this->load->model("DaftarBarang_model");
        $this->load->library('pagination');
        $this->load->helper('url');
        if ($this->session->userdata['jabatan'] == "")
        {
            //do something
            redirect('Login'); 
        }
    }

    public function index()
    {
        $data["Products"] = $this->InputanBarang_model->getAll();

        $this->load->view("Barang");
        // if($_SESSION["done"] !="done"){
        //     $this->load->view("Barang");
        // }else{
        //     $this->load->view("Proposal");
        // }
    }
    public function showBarang(){
        $Barang= $this->DaftarBarang_model;
        $id=$_POST["idBarang"];
        // $data["listBarang"] = $id;
        // echo $id;
        $where = array(
            'kategori_barang' => $id
        );
        $ListBarang= $Barang->getDatabyCategory($where);
        foreach($ListBarang as $each){
            echo "<option value='". $each->id_barang."'>" . $each->nama_barang . "</option>";
        }
     
        // echo json_encode($data);
    }
    public function goDetail(){
        $params = array();
        $id=$_POST["nama"];
        $limit_per_page = 10;
        $where = array(
            'id_barang'=>  $id
        );
        // $historyModel=$this->HistoryHargaBarang_model;
        $history = $this->HistoryHargaBarang_model;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $history->get_count_history_price($id);
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $params["results"]= $history->get_current_page_records_history($limit_per_page, $start_index,$where);
            $config["base_url"] = site_url() . "/HistoryBarang/showHarga";
            $config["total_rows"] = $history->get_count_history_price($id);
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();

        }
        // $data=array("value" => $hargapenetapan, "formatted" => $formatted); // This is your data array/result
        // echo json_encode($data); // u
        $params["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
        $this->load->view("DetailHistory",$params);
    }

    public function showHarga(){
        $params = array();
        $id=$_POST["idBarang"];
        $limit_per_page = 10;
        $where = array(
            'id_barang'=>  $id
        );
        // $historyModel=$this->HistoryHargaBarang_model;
        $history = $this->HistoryHargaBarang_model;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $history->get_count_history_price($id);
        if($total_records > 0){
            // $cek = $this->User_model->get_jabatan("user",$where)->num_rows();
            // if($cek > 0){
            //     $jabatan = $this->User_model->get_jabatan("user",$where)->row()->jabatan;
            $params["results"]= $history->get_current_page_records_history($limit_per_page, $start_index,$where);
            $config["base_url"] = site_url() . "/HistoryBarang/showHarga";
            $config["total_rows"] = $history->get_count_history_price($id);
            $config["per_page"] = $limit_per_page;
            $config["uri_segment"] = 3;
            $config['cur_tag_open'] = '<div class="pagination">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<span class="paginationA">';
            $config['num_tag_close'] = '</span>';
            $this->pagination->initialize($config);
            $params["links"]= $this->pagination->create_links();

        }
        // $data=array("value" => $hargapenetapan, "formatted" => $formatted); // This is your data array/result
        // echo json_encode($data); // u
        $params["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
        echo json_encode($params);
        // $this->load->view("HistoryBarang",$params);

    }

    public function checkHarga(){
     $hargainput=$_POST['hargaInput'];
     $kodeBarang = $_POST['idBarang'];
     $hargapenetapan =  $this->DaftarBarang_model->getHarga($kodeBarang)->harga_penetapan;
    
     if($hargainput>$hargapenetapan){
         $stringError = "Harga yang diinputkan melebihi harga penetapan";
     }
     else{
         $StringError ="Sudah benar";
     }
     echo $stringError;
    }

    public function add()
    {
        $Products = $this->InputanBarang_model;
        $validation = $this->form_validation;
        $validation->set_rules($Products->rules());
        $where = array(
			'status_aktif' => "aktif",
			'approve' => 1
			);
        $data["ListBarang"] = $this->DaftarBarang_model->getBarangApproved($where);
        // $data["ListBarang"] = $this->DaftarBarang_model->getAll();    
        if ($validation->run()) {
            $Products->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            if (!empty($_POST['btnMore'])) {
                // submit button pressed
                    $this->load->view("Barang",$data);
                }
                if (!empty($_POST['btnDone'])) {
                    $this->load->view("Menu");
                }
        }else{
            $this->load->view("Barang");
        }


    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/products');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("admin/product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}