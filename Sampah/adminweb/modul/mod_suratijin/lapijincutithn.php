<?php
require('../../../fpdf/fpdf.php'); 
include "../../../config/koneksi.php";	
include "../../../config/fungsi_indotgl.php";
$tgl_now = tgl_indo(date("Y/m/d"));
$bln = $_POST['bulan'];  
$tahun = date("Y");
//UPDATE permohonan_cuti SET status_pengajuan = 'setuju' WHERE id_pcuti = '$_GET[id]'
//mysql_query("UPDATE permohonan_cuti SET status = '1' WHERE id_pcuti = '$_GET[id]'");

$pdf = new FPDF('P','mm','A4');
$pdf->Open();
$pdf->addPage();
$pdf->setAutoPageBreak(false);
//Judul
$pdf->setFont('times','B',12,'C');
$pdf->Image('../../../foto/logo.jpg',20,10,20,25);
//$pdf->text(62,12,'Program Megister');
$pdf->setFont('times','B',12,'C');
//$pdf->text(60,15,'PEMERINTAHAN PROVINISI KALIMANTAN TENGAH');
$pdf->setXY(20,10); $pdf->MultiCell(A4,5,'PEMERINTAHAN PROVINSI KALIMANTAN TENGAH',0,'C');
$pdf->setFont('times','B',19,'C');
//$pdf->text(65,20,'DINAS KELAUTAN DAN PERIKANAN');
$pdf->setXY(20,16); $pdf->MultiCell(A4,5,'DINAS KELAUTAN DAN PERIKANAN',0,'C');
$pdf->setFont('times','B',10,'C');
//$pdf->text(45,25,'Jl. Brigjend Katamso No.2 Telp./Fax (0536) 3229663/3220517 Tromol Pos 41');
$pdf->setXY(20,21); $pdf->MultiCell(A4,5,'Jl. Brigjend Katamso No.2 Telp./Fax (0536) 3229663/3220517 Tromol Pos 41',0,'C');
$pdf->setFont('times','B',12,'C');
//$pdf->text(90,30,'PALANGKA RAYA,73112');
$pdf->setXY(20,26); $pdf->MultiCell(A4,5,'PALANGKA RAYA,73112',0,'C');

//$pdf->setFont('times','',9,'C');
//$pdf->text(35,24,'Jl. Diponegoro No.19 Palangka Raya');
//$pdf->text(35,30,'Telepon (0536) 3221784');

//Garis
$pdf->Line(20,36,190,36);
$pdf->Line(20,37,190,37);

$idnya = $_GET['id'];
$datex = date("Y");

//SELECT 
	 //permohonan_cuti.*,
	 //pegawai.nama,
	 //jabatan.nm_jabatan,
	 //golongan.*
	 //FROM permohonan_cuti INNER JOIN pegawai ON pegawai.nip = permohonan_cuti.nip
	 //INNER JOIN jabatan ON jabatan.id_jabatan = permohonan_cuti.id_jabatan
	 //INNER JOIN golongan on golongan.id_gol = permohonan_cuti.id_gol


$query = mysql_query("SELECT *, DATE_FORMAT(tgl_mulai,'%d-%b-%Y') AS tgl_mulai, DATE_FORMAT(tgl_akhir,'%d-%b-%Y') AS tgl_akhir  FROM permohonan_cuti
     INNER JOIN pegawai ON permohonan_cuti.nip=pegawai.nip
     INNER JOIN jns_cuti ON permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     INNER JOIN jabatan ON permohonan_cuti.id_jabatan=jabatan.id_jabatan
     INNER JOIN golongan ON permohonan_cuti.id_gol=golongan.id_gol
	 where id_pcuti ='$_GET[id]'");
$data  = mysql_fetch_array($query);

$pdf->setFont('times','',12,'C');
$pdf->text(130,42,'Palangka Raya,');
$pdf->text(160,42,$tgl_now);
$pdf->setFont('times','B',12,'C');
$pdf->setXY(20,48); $pdf->MultiCell(A4,5,'SURAT IZIN CUTI TAHUNAN',0,'C');
$pdf->Line(80,53,140,53);
$pdf->text(88,57,'No.SB3/TU.');
$pdf->text(89,57,$data['id_sku']);
$pdf->text(118,57,'/');
$pdf->text(119,57,$datex);
$pdf->text(128,57,'.K');

$pdf->setFont('times','',12,'C');
$pdf->text(20,70,'1. Diberikan cuti tahunan untuk tahun tahun');$pdf->text(96,70,$datex);$pdf->text(106,70,'kepada Pegawai Negeri Sipil :');

$pdf->text(35,80,'Nama');$pdf->text(80,80,':');$pdf->text(85,80,$data['nama']);
$pdf->text(35,86,'NIP');$pdf->text(80,86,':');$pdf->text(85,85,$data['nip']);
$pdf->text(35,92,'Pangkat/Golongan Ruang');$pdf->text(80,92,':');$pdf->text(85,92,$data['nm_pangkat']);$pdf->text(128,92,'/');$pdf->text(130,92,$data['nm_gol']);$pdf->text(135,92,'/');$pdf->text(138,92,$data['ruang']);
$pdf->text(35,98,'Jabatan');$pdf->text(80,98,':');$pdf->text(85,98,$data['nm_jabatan']);
$pdf->text(35,104,'Satuan Organisasi');$pdf->text(80,104,':');$pdf->text(84,104,'Dinas Kelautan dan Perikanan Provinsi Kalimantan Tengah');

//$pdf->setXY(40,115); $pdf->MultiCell(155,6,'Sebelum menjalankan cuti tahunan wajib menyerahkan pekerjaannya kepada atasan langsung.
//Setelah selesai menjalankan cuti tahunan wajib melaporkan diri kepada atasan langsung dan bekerja kembali sebagaimana biasa.',0,'J');

$pdf->text(35,115,'Selama');
$pdf->text(50,115,$data['lama_cuti']);
$pdf->text(55,115,'hari kerja,');
$pdf->text(75,115,'terhitung mulai tanggal');
$pdf->text(118,115,$data['tgl_mulai']);
$pdf->text(147,115,'sampai dengan');
$pdf->text(35,121,$data['tgl_akhir']);
$pdf->text(60,121,'dengan ketentuan sebagai berikut :');
$pdf->text(35,127,'1. Sebelum menjalankan cuti tahunan wajib menyerahkan pekerjaannya kepada atasan');
$pdf->text(39,133,'langsung.');
$pdf->text(35,139,'2. Setelah selesai menjalankan cuti tahunan wajib melaporkan diri kepada atasan');
$pdf->text(39,145,'langsung dan bekerja kembali sebagaimana biasa.');

$pdf->text(20,155,'2. Demikian surat izin cuti ini dibuat untuk dapat digunakan sebagaimana mestinya.');

$pdf->setFont('times','',12,'C');
$pdf->text(140,170,'Kepala Dinas,');

//$NAMA = mysql_query("select * from pegawai where id_jabatan ='1'");
//$kep  = mysql_fetch_array($NAMA);
$pdf->setFont('times','B',12,'C');
$pdf->text(135,190,'Ir. DARMAWAN');
$pdf->Line(135,191,167,191);
$pdf->text(130,196,'Pembina Utama Madya');
$pdf->text(125,202,'NIP. 19580418 198712 1 001');

$pdf->output();
?> 




