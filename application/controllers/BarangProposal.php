<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BarangProposal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("InputanBarang_model");
        $this->load->library('form_validation');
        $this->load->model("DaftarBarang_model");
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
    public function ChangeNama(){
        $kodeBarang=$_POST['idBarang'];
        $nama=$_POST['namaBarang'];
        $hargapenetapan =  $this->DaftarBarang_model->getHarga($kodeBarang)->harga_penetapan;
        $hargapenetapan2 =  $this->DaftarBarang_model->getHarga($kodeBarang)->harga_penetapan;
        $_SESSION["harga_penetapan"]=$hargapenetapan;
        $_SESSION["namaBarang"]=$nama;
        $formatted= number_format($hargapenetapan);
        
        $data=array("value" => $hargapenetapan, "formatted" => $formatted); // This is your data array/result
        echo json_encode($data); // u
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