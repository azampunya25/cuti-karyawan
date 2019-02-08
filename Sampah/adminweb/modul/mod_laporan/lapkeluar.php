<?php
require('../../../fpdf/fpdf.php'); 
include "../../../config/koneksi.php";	
include "../../../config/fungsi_indotgl.php";
$tgl_now = tgl_indo(date("Y/m/d"));
$bln = '5';  
$tahun = date("Y");

class PDF extends FPDF
{
	//Page header
	function Header()
	{
		//Logo
		$this->Image('../../../foto/logo.jpg',35,10,17,18);
		//Arial bold 15
		$this->SetFont('times','B',15);
		//pindah ke posisi ke tengah untuk membuat judul
		$this->Cell(80);
		//judul
		$this->setXY(10,10); $this->MultiCell(A4,5,'PEMERINTAHAN PROVINSI KALIMANTAN TENGAH',0,'C');
		$this->setXY(10,15); $this->MultiCell(A4,5,'DINAS KELAUTAN DAN PERIKANAN',0,'C');
		$this->setXY(10,20); $this->MultiCell(A4,5,'Jl. Brigjend Katamso No.2 Telp./Fax (0536) 3229663/3220517 Tromol Pos 41',0,'C');
		$this->setXY(10,25); $this->MultiCell(A4,5,'PALANGKA RAYA,73112',0,'C');
		//pindah baris
		$this->Ln(20);
		//buat garis horisontal
		$this->Line(20,31,280,31);
		$this->Line(20,32,280,32);
	}

	//Page footer
	function Footer()
	{
		//atur posisi 1.5 cm dari bawah
		$this->SetY(-15);
		//buat garis horizontal
		$this->Line(10,$this->GetY(),280,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
	}
}

//contoh pemanggilan class
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();

$pdf->AddPage();
	
	$pdf->setXY(10,40);$pdf->setFillColor(255,255,255);
	$pdf->CELL(0,6,'LAPORAN SURAT KELUAR SUBBAGUMUM',0,0,'C',0);
	$pdf->setFont('times','',10);
	$pdf->setFillColor(222,222,222);
	$pdf->setXY(20,50);

	//$pdf->setFont('times','',12,'C');

		$yx   = 100;
		$yy   = 34;
		$row2 = 6;
		$yu   = 66;

	$pdf->setFont('times','',10);
	$pdf->setFillColor(222,222,222);
	$pdf->setXY(20,60);
	$pdf->CELL(10,6,'No',1,0,'C',1);
	$pdf->CELL(35,6,'No Agenda',1,0,'C',1);
	$pdf->CELL(50,6,'Asal Surat',1,0,'C',1);
	$pdf->CELL(20,6,'Tgl Terima',1,0,'C',1);
	$pdf->CELL(20,6,'Tgl Surat',1,0,'C',1);
	$pdf->CELL(95,6,'Perihal',1,0,'C',1);


		//$yy = $yx + $row2;
		$no=1;
		$i=1;
		//$jur = $_GET['id'];  
		//$tahun2 = date("Y");
		$query = mysql_query("SELECT * FROM suratkeluar WHERE (((tgl_surat) BETWEEN '".$_POST['dari']."' AND '".$_POST['sampai']."'))");	  
		while ($data= mysql_fetch_array($query)){
			
			$pdf->setXY(20,$yu);
			$pdf->setFont('times','',9);
			$pdf->setFillColor(255,255,255);
			
			$pdf->CELL(10,6,$no.'.',1,0,'C',1);
			$pdf->CELL(35,6,$data['s_no_sk'],1,0,'C',1);
			$pdf->CELL(50,6,$data['pengirim'],1,0,'L',1);	
			$pdf->CELL(20,6,$data['tgl_surat'],1,0,'C',1);	
			$pdf->CELL(20,6,$data['tujuan'],1,0,'C',1);	
			$pdf->CELL(95,6,$data['perihal'],1,0,'C',1);	
			$yu = $yu + 6;
			$no++;$i++;
		}
$pdf->Output();
?>