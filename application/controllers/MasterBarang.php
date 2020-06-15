<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MasterBarang extends CI_Controller
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
        $this->load->model("DaftarBarang_model");
        $this->load->model("HistoryHargaBarang_model");
        if ($this->session->userdata['jabatan'] == "")
        {
            //do something
            redirect('Login'); 
        }
        
    }

    public function index()
    {

    }

    public function add()   
    {
        $Barang = $this->DaftarBarang_model;
        $validation->set_rules($Barang->rulesUpdate());
            
        if ($validation->run()) {
            // $Products->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        if (!empty($_POST['btnMore'])) {
        // submit button pressed
            $this->load->view("Barang");
        }
        if (!empty($_POST['btnDone'])) {
            $this->load->view("Menu");
        }

    }
    public function changeHargaPenetapan(){
        $History = $this->HistoryHargaBarang_model;
        $Barang = $this->DaftarBarang_model;
        
        $Barang->update(); //untuk update harga request dan konfirmasi
        $History->save();   //untuk insert ke history harga barnag
        $this->session->set_flashdata('success', 'Berhasil diupdate');

        //bikin agar semua history approve jadi 0 yang berarti belum di approve
        $id=$_POST["nama"];      
        $data = array(
            'approve' => 0,
            'id_barang' => $id
        );
        if($this->HistoryHargaBarang_model->unapproveHarga($data)){
            $where = array(
                'id_barang'=>  $id
            );
            
            $this->HistoryHargaBarang_model->unapproveHarga($data);
        }else{
            echo "fail";
        }
        $data["nonConfirmed"]=$this->DaftarBarang_model->get_total_non_confirmed();
        $this->load->view("Menu",$data);
    }

    // public function showBarang(){
    //     $Barang= $this->DaftarBarang_model;
    //     $id=$_POST["idBarang"];
    //     // $data["listBarang"] = $id;
    //     // echo $id;
    //     $where = array(
    //         'kategori_barang' => $id
    //     );
    //     $ListBarang= $Barang->getDatabyCategory($where);
    //     foreach($ListBarang as $each){
    //         echo "<option value='". $each->id_barang."'>" . $each->nama_barang . "</option>";
    //     }
     
    //     // echo json_encode($data);
    // }
    public function showBarangHistory(){
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
     
    }

    public function showHarga(){
        $Barang= $this->DaftarBarang_model;
        $id=$_POST["idBarang"];
        $where = array(
            'id_barang' => $id
        );
        $ListBarang= $Barang->getHargabyId($where);
        foreach($ListBarang as $each){
            echo "Harga yang disetujui sekarang: Rp. " . number_format($each->harga_penetapan);
        }
    }
    public function showBarang(){
     
        $Barang= $this->DaftarBarang_model;
        $id=$_POST["idBarang"];
        $approve=$_POST["idStatus"];
        // $data["listBarang"] = $id;
        // echo $id;
        $where = array(
            'kategori_barang' => $id,
            'approve' => $approve
        );
        $ListBarang= $Barang->getDatabyCategory($where);
        foreach($ListBarang as $each){
            echo "<option value='". $each->id_barang."'>" . $each->nama_barang . "</option>";
        }
        
    }

    public function gotoaddBarang()
    {
        $Barang = $this->DaftarBarang_model;
        $validation = $this->form_validation;
        $validation->set_rules($Barang->rules());
        
        //untuk cek kondisi status udah aktif dan barang udah di approve oleh pak anthony
        $info = array(
			'status_aktif' => "aktif",
            'approve' => 0
        );
        $History = $this->HistoryHargaBarang_model;
        $data['Departemen'] = $this->Departemen_model->getAll();
        $_SESSION["idBarang1"] = $this->DaftarBarang_model->save($info);
        
        if ($validation->run()) {
            $History->savePertama();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        } 

        $this->load->view("InsertNewBarang",$data);
    }

    public function confirmHarga()
    {
        $id=$_GET['id'];      
        $data = array(
            'approve' => 1,
            'id_barang' => $id
        );
        $this->load->model("DaftarBarang_model");
        if($this->DaftarBarang_model->approveHarga($data)){
            $where = array(
                'approve'=>  0
            );
            
            $this->HistoryHargaBarang_model->approveHarga($data);
        }else{
            echo "fail";
        }
        
    }
    public function rejectHarga(){
        $id=$_GET['id'];      
        $data = array(
            'approve' => 2,
            'id_barang' => $id
        );
        $this->load->model("DaftarBarang_model");
        if($this->DaftarBarang_model->rejectHarga($data)){
            echo "Request Harga telah direject";
        }else{
            echo "fail";
        }
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('admin/products'));
        }
    }
}