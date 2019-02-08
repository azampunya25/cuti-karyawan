<?php
//Persetujuan Cuti
if ($module=='persetujuan_cuti' AND $act=='setuju'){
	$id_pcuti=$_GET['id_pcuti'];
	$nip=$_GET['nip'];
	$nama=$_GET['nama'];
    //echo "setuju";
    mysql_query("UPDATE permohonan_cuti,pegawai SET
                permohonan_cuti.status_pengajuan='setuju', pegawai.status_pegawai='cuti'
                WHERE permohonan_cuti.id_pcuti='$id_pcuti' AND pegawai.nip='$nip'");
    header('location:media.php?module='.$module);
}

//Persetujuan Cuti Tidak disetujui
elseif ($module=='persetujuan_cuti' AND $act=='tdksetuju'){
	$id_pcuti=$_GET['id_pcuti'];
	$nip=$_GET['nip'];
	$nama=$_GET['nama'];
    //echo "setuju";
    mysql_query("UPDATE permohonan_cuti,pegawai SET
                permohonan_cuti.status_pengajuan='tidak',pegawai.status_pegawai='aktif'
                 WHERE permohonan_cuti.id_pcuti='$id_pcuti' AND pegawai.nip='$nip'");
    header('location:media.php?module='.$module);
}
?>