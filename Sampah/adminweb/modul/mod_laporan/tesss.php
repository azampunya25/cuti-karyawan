   // 	function ubahformatTgl($tanggal) {
   //     $pisah = explode('-',$tanggal);
   //     $urutan = array($pisah[2],$pisah[1],$pisah[0]);
    //    $satukan = implode('-',$urutan);
  //      return $satukan;
  //  }
    
	// Cara penggunaan function ubahTgl
  //  $ubahtglsurat = ubahformatTgl($tgl_surat);
	
    // Ambil variabel dari form
  //  $no_sk = $_POST['no_sk'];
//	$tgl_surat = $_POST['tgl_surat'];
  ///  $pengirim = $_POST['pengirim'];
//	$tujuan = $_POST['tujuan'];
//	$perihal = $_POST['perihal'];
  
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratkeluar)</script>";
    }
    else{
    UploadSuratKeluar($nama_file_unik);

    mysql_query("INSERT INTO suratkeluar(no_sk,tgl_surat, pengirim, tujuan, perihal, gambar) 
                            VALUES('$_POST[no_sk]',
                                   '$_POST[tgl_surat],
								   '$_POST[pengirim],
                                   '$_POST[tujuan], 
                                   '$_POST[perihal],
                                   '$nama_file_unik')");
//	mysql_query("INSERT INTO historiskeluar(no_sk,tgl_surat, pengirim, tujuan, perihal) 
    //                        VALUES('$_POST[no_sk]',
    //                               '$_POST[tgl_surat],
	//							   '$_POST[pengirim],
      //                             '$_POST[tujuan], 
       //                            '$_POST[perihal]')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO suratkeluar(no_sk,tgl_surat, pengirim, tujuan, perihal) 
                            VALUES('$_POST[no_sk]',
                                   '$_POST[tgl_surat],
								   '$_POST[pengirim],
                                   '$_POST[tujuan], 
                                   '$_POST[perihal]')");
	//mysql_query("INSERT INTO historiskeluar(no_surat_k,tgl_surat, pengirim, tujuan, perihal) 
              //              VALUES('$_POST[no_sk]',
         //                          '$_POST[tgl_surat],
				//				   '$_POST[pengirim],
            //                       '$_POST[tujuan], 
                   //                '$_POST[perihal]')");
  header('location:../../media.php?module='.$module);
  }