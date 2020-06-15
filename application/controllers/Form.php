<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('fpdf');
        $this->load->model("Proposal_model");
        $this->load->model("InputanBarang_model");
    }
 
    function index(){
        // $data = $this->specific_proposal();
        $kdpro = $_GET["kdpro"];
        $grandTotal = 0;
        $dataBarang = $this->InputanBarang_model->getById($kdpro);
        $dataProposal = $this->Proposal_model->specific_proposal($kdpro);
        // $dataProposal = $this->db->get_where('info_proposal', ["nomor_proposal" => $kdpro])->result();
        // $data = $this->db->get('info_proposal')->result();
        $pdf = new FPDF('P','mm','A4');
        // membuat halaman baru
        foreach($dataProposal as $row)
        {   
            $pdf->AddPage();
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial','B',16);
            // mencetak string 
            $widthPage=$pdf->GetPageWidth();
            $pabrik = explode(";", $row->pabrik);
            $pdf->Cell(19,5,''.$pabrik[0] ,0,    1,'C');
            $pdf->Cell(23,5,''.$pabrik[1] ,0,1,'C');
            // $pdf->Cell(20,5,'UNIT-1',0,1,'C');
            $pdf->Cell($widthPage,5,'PROPOSAL PEMBELIAN',0,1,'C');
            // Memberikan space kebawah agar ti dak terlalu rapat
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(10,5,'Tanggal            : ' . $row->tanggal ,0,1);
            $pdf->Cell(10,5,'Nomor              : '. $row->nomor ,0,1);
            $pdf->Cell(10,5,'Departemen     : ' . $row->department,0,1);
            $pdf->Cell(10,5,'Lokasi              : ' . $row->lokasi,0,1);
            $pdf->Cell(10, 5, '',0,1); 
            //X,Y,W,H
            $pdf->Rect(10, 50, $widthPage-20    , 10, 'D'); //kotak untuk samping keperluan
            $pdf->Cell(10,5,'Keperluan                              : ' . $row->keperluan,0,1);
            $pdf->Cell(10,5,'',0,1);
            $pdf->Rect(10, 60, $widthPage-20, 10, 'D'); //kotak samping jenis
            // $pdf->Rect(10, 60, 250, 15, 'D'); 
            $pdf->Cell(10,5,'Jenis                                      : ' . $row->jenis,0,1);
            $pdf->Cell(10,5,'',0,1);
            // $pdf->Rect(10, 50, 250, 5, 'D'); 
            $pdf->Rect(10, 70, $widthPage-20, 20, 'D'); //kotak sampign pertimbangan & manfaat
            $w=$pdf->GetstringWidth($row->pertimbangan);
            $w1=strlen($row->pertimbangan);
            // $pdf->Cell(10,5,'Pertimbangan & Manfaat     : ' . $row->pertimbangan,0,1);
            //ini adalah row pertimbangan & manfaat konsepnya dibikin jadi 2 row , dengan width sisa 143 biar gak terlalu mepet dengan kotak
           //satu string memiliki lebar widtth berikut
            $satustring=ceil($w/$w1);
            $widthMax = 135;
            $totalbagi = ceil($w/$widthMax);
   
            if($totalbagi==1){
                $pdf->Cell(49,6,'Pertimbangan & Manfaat     :',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$row->pertimbangan,0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,'',0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,'',0,1,'LR');
            }elseif($totalbagi==2){
                $arrString=str_split($row->pertimbangan,$widthMax/$satustring);
                $pdf->Cell(49,6,'Pertimbangan & Manfaat     :',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$arrString[0],0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$arrString[1],0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,'',0,1,'LR');
            }else{
                $arrString=str_split($row->pertimbangan,$widthMax/$satustring)    ;
                $pdf->Cell(49,6,'Pertimbangan & Manfaat     :',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$arrString[0],0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$arrString[1],0,1,'LR');
                $pdf->Cell(10,6,'',0,0,'LR');
                $pdf->SetX(60);
                $pdf->Cell(135  ,6,$arrString[2],0,1,'LR');
            }
            $pdf->SetX(10);
            // $pdf->SetY(-10);
            $pdf->Rect(10, 95, $widthPage-20, 25, 'D'); //kotak diajukan kanan
            $w = array(70, 45, 45, 45 ,45);
            $header = array($row->keterangan, 'Disetujui', 'Diketahui', 'Mengetahui','Diajukan');
            $header2 = array('Direktur / GM', 'Plant Manager','Manager PPIC', $row->diajukan);
            $width2 = ($widthPage*2/3/4);
            // BARIS KETERANGAN
            $pdf->Rect(10, 95, $widthPage-50, 25, 'D'); //kotak mengetahui kanan
            $pdf->Rect(10, 95, $widthPage-80, 25, 'D'); //kotak diketahui kanan
            $pdf->Rect(10, 95, $widthPage-110, 25, 'D'); //kotak disetujui kanan
            $pdf->Rect(10, 95, $widthPage-140, 25, 'D'); //kotak keterangan
            //kolom keterangan
            
            $pdf->Cell($widthPage/3/2-10,20,"Keterangan :",0,0,'LR');
            $pdf->Cell($widthPage/3/2+10,20,$row->keadaan,0,1,'LR');
            $pdf->Cell($widthPage/3/2-10,0,"",0,0,'LR');
            $pdf->Cell($widthPage/3/2+10,0,"",0,0,'LR');
            // $pdf->Cell(10,20,"",1,0,'LR');
            // $pdf->Cell($widthPage/3/2-5,20," ",1,0,'LR');
            $pdf->Cell(30,-20,$header[1],0,0,'L');
            $pdf->Cell(30,-20,$header[2],0,0,'L');
            $pdf->Cell(30,-20,$header[3],0,0,'L');
            $pdf->Cell(30,-20,$header[4],0,0,'L');
            $pdf->Cell($w[4],47,'',0,1,'L');
            $pdf->Cell($w[0],0,'',0,0,'L');
            $pdf->Cell(30,-75,$header2[0],0,0,'L');
            $pdf->Cell(30,-75,$header2[1],0,0,'L');
            $pdf->Cell(30,-75,$header2[2],0,0,'L');
            $pdf->Cell(30,-75,$header2[3],0,0,'L');
            $pdf->Cell(30,-10,'',0,0,'L');;
            $pdf->setY(135);
            $pdf->SetFont('Arial','B',16);
            $width_cell=array(10,30,20,30);
            $pdf->Ln();
            $pdf->Cell($widthPage,10,'PERKIRAAN BIAYA',0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(10,5,'Nama Supplier                      : ',0,1);
            $pdf->Cell(10,5,'Syarat pembayaran              :',0,1);
            $pdf->Cell(10,5,'Jadwal pengiriman               :',0,1);
            $pdf->SetFillColor(193,229,252); // Background color of header        
        }
      
        $w = array(8, 63, 40, 15, 30, 35);
        // Header
        $headerBarang = array('No ', 'Nama Barang', 'Spesifikasi', 'Qty', 'Harga@','Jumlah');
        $ctr=1;
      
        for($i=0;$i<count($headerBarang);$i++)
            // $pdf->Cell($w[$i],8,$i,1,0,'C')
            $pdf->Cell($w[$i],7,$headerBarang[$i],1,0,'C');
            $pdf->Ln();
        // Data
        
        foreach($dataBarang as $row)
        {   
            $grandTotal+=$row->total_perkiraan_biaya;
            $pdf->Cell($w[0],6,$ctr,1,0,'LR');
            $pdf->Cell($w[1],6,$row->nama,1,0,'LR');
            $pdf->Cell($w[2],6,$row->spesifikasi,1,0,'LR');
            $pdf->Cell($w[3],6,$row->jumlah,1,0,'LR',0,'R');
            $pdf->Cell($w[4],6,number_format($row->perkiraan_biaya_unit),1,0,0,'R');
            $pdf->Cell($w[5],6,number_format($row->total_perkiraan_biaya),1,0,0,'R');
            $pdf->Ln();
            $ctr++;
        }
        //yang dihitung adalah sisa row yang tersisa;
        $rowkosong=13-$ctr;
        if($rowkosong>=0){
            for($i=0;$i<=$rowkosong;$i++){
                $pdf->Cell($w[0],6,$rowkosong,1,0,'LR');
                $pdf->Cell($w[1],6,$ctr,1,0,'LR');
                $pdf->Cell($w[2],6,$i,1,0,'LR');
                $pdf->Cell($w[3],6,'',1,0,'LR',0,'R');
                $pdf->Cell($w[4],6,'',1,0,'LR',0,'R');
                $pdf->Cell($w[5],6,'',1,0,'LR',0,'R');
                $pdf->Ln();
          
            }
        }
        $pdf->Cell(156,6,"Total",1,0,'R');
        $pdf->Cell(35,6,number_format($grandTotal),1,0,'R');
        $pdf->Ln();
        $pdf->Ln();
        $header3 = array('','Diperiksa','Diisi');
        $header4 = array('','Mngr.Pembelian','Pembelian');
        
        $pdf->Cell(126,25,$header3[0],1,0,'L');//kolom besar 
        $pdf->Cell(30,5,$header3[1],1,0,'L');//kolom diisi
        $pdf->Cell(35,5,$header3[2],1,1,'L');//kolom diisi
        $pdf->SetX(136);
        $pdf->Cell(30,15,'',1,0,'LR');//kolom tanda tangan utk dibawah diperiksa
        $pdf->Cell(35,15,'',1,1,'LR'); //LR adalah untuk row ke kanan, 1,0 artinya border +ke kanan
        //sedangkan 1,1 artinya border + enter kebawah
        // $pdf->Cell(30,15,'',1,,'L');
        $pdf->SetX(10);
        $pdf->Cell(126,2.5,$header4[0],0,0,'L');
        $pdf->Cell(30,5,$header4[1],1,0,'L');

        $pdf->Cell(35,5,$header4[2],1,0,'L');

        $pdf->Output();

    }

}