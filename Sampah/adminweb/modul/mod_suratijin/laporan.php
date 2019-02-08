<?php  

/**
 * @author Achmad Solichin
 * @website http://achmatim.net
 * @email achmatim@gmail.com
 */
require_once("../../../fpdf/fpdf.php");
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";


class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'F4',
  		'orientation'=>'L'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		
		//header
		$this->SetFont("Times", "B", 18);
		$this->Image('../../../foto/logo.jpg',70,15,80);
		$this->Cell(0, 10, 'PEMERINTAHAN PROVINSI KALIMANTAN TENGAH', 0, 1,'C');
		$this->Ln(10);
		$this->Cell(0, 10, 'DINAS KELAUTAN DAN PERIKANAN', 0, 1,'C');
		$this->Ln(10);
		$this->Cell(0, 10, 'Brigjend Katamso No.2 Telp./Fax (0536) 3229663/3220517 Tromol Pos 41', 0, 1,'C');
		$this->Ln(20);
		$this->SetFont("Times", "B", 14);
		$this->Cell(0, 5, 'PALANGKA RAYA,73112', 0, 1,'C');
		$this->Ln(30);
		$this->Cell(0, 1, " ", "B");
		$this->Ln(10);
		$this->SetFont("Times", "B", 16);
		$this->SetX($left); $this->Cell(0, 10, 'LAPORAN DATA CUTI PEGAWAI', 0, 1,'C');
		$this->Ln(20);
		
		
		$h = 15;
		$left = 30;
		$top = 90;	
		#tableheader
		$this->SetFillColor(200,200,200);	
		$this->SetFont('Times',"B",10);
		$this->SetWidths(array(30,80,60,140,80,80,80,80));
		$this->SetAligns(array('C','C','C','C','C','C','C','C'));
		$this->Row(array('No','Tahun','NIP','Nama','Jenis Cuti','Tgl Mulai',
						 'Tgl Akhir','Lama Cuti'));
		
		
		$this->SetFont('Times','',10);
		$this->SetWidths(array(30,80,60,140,80,80,80,80,80,100,30,30));
		$this->SetAligns(array('C','L','L','L','L','L','L','L','L','L','L','L'));
		$no = 1; $this->SetFillColor(255);
		foreach ($this->data as $baris) {
			$this->Row(
				array($no++, 
				$baris['tahun'], 
				$baris['nip'], 
				$baris['nama'], 
				$baris['id_jcuti'], 
				$baris['tgl_mulai'],
				$baris['tgl_akhir'],
				$baris['lama_cuti']
//				$baris['tgl_lahir'],
	//			$baris['alamat'],
		//		$baris['rt'],
			//	$baris['rw']
			));
		}
		$this->Ln(100);
		$this->SetFont("Times", "", 15);
		$this->SetX(500);
//		$this->Cell(0, 10, 'Palangka Raya,', 0, 1,'C');
		$this->Ln(10);
		$this->SetX(500);
//		$this->Cell(0, 10, 'Mengetahui :', 0, 1,'C');
		$this->Ln(10);
		$this->SetX(500);
//		$this->Cell(0, 10, 'Kepala Bagian Umum dan Kepegawaian', 0, 1,'C');
		$this->Ln(10);
		$this->SetX(700);
		//$this->Cell(0, 10, 'dan Ketentraman', 0, 1,'C');
		$this->Ln(50);
		$this->SetX(500);
		$this->SetFont("Times", "B", 15);
		$this->SetX(500);
//		$this->Cell(0, 5, 'MUHAMMAD IBRAHIM, S.Sos', 0, 1,'C');
		$this->Ln(10);
		$this->SetX(500);
//		$this->Cell(0, 5, 'NIP. 19740608 199803 1 004', 0, 1,'C');
		$this->Output();		

	}

	public function printPDF () {
				
		if ($this->options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
	
	    $this->rptDetailData();
			    
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	
  	
  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class


 
#ambil data dari DB dan masukkan ke array
$data = array();
//ambil data penandatangan surat keterangan domisili
//if (($_POST['cetakbulan']) < 13) {
	  //  $bulancetak = $_POST['cetakbulan'];
//		$tahuncetak = $_POST['cetaktahun'];
	//	$query="SELECT * FROM sk_berkelakuanbaik WHERE month(tanggal) = $bulancetak AND year(tanggal) = $tahuncetak";
//} else {
		//$tahuncetak = $_POST['cetaktahun'];
	//	$query="SELECT * FROM sk_berkelakuanbaik WHERE year(tanggal) = $tahuncetak";
//}

$query = "SELECT * FROM permohonan_cuti inner join pegawai on permohonan_cuti.nip=pegawai.nip 
WHERE (((tgl_mulai) BETWEEN '".$_POST['dari']."' AND '".$_POST['sampai']."')) and status_pengajuankadis='setuju'";  
$sql = mysql_query ($query);
while ($row = mysql_fetch_assoc($sql)) {
array_push($data, $row);
}

//pilihan
$options = array(
	'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => '', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'F4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'L' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
