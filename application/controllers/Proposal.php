<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Proposal_model");
        $this->load->model("Departemen_model");
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
        $data["Proposal"] = $this->Proposal_model->getAll();
        // $data["Nomer"] = $this->
        $data['Departemen'] = $this->Departemen_model->getAll();
        $this->load->view("Proposal",$data);
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

    public function integerToRoman($integer)
    {
     // Convert the integer into an integer (just to make sure)
     $integer = intval($integer);
     $result = '';
     
     // Create a lookup array that contains all of the Roman numerals.
     $lookup = array('M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);
     
     foreach($lookup as $roman => $value){
      // Determine the number of matches
      $matches = intval($integer/$value);
    
      // Add the same number of characters to the string
      $result .= str_repeat($roman,$matches);
      // Set the integer to be the remainder of the integer and the value
      $integer = $integer % $value;
     }
     // The Roman numeral should be built, return it
     return $result;
    }

    public function gotoaddBarang()
    {
        $Proposal = $this->Proposal_model;
        $validation = $this->form_validation;
        $validation->set_rules($Proposal->rules());
        
        //untuk cek kondisi status udah aktif dan barang udah di approve oleh pak anthony
        $where = array(
			'status_aktif' => "aktif",
			'approve' => 1
			);
        $data["ListBarang"] = $this->DaftarBarang_model->getBarangApproved($where);
        if ($validation->run()) {
            $Proposal->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        } 

        $this->load->view("Barang",$data);
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