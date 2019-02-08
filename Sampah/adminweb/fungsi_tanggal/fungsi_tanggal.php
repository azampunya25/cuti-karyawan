<?php

//FUNGSI AMBIL TANGGAL SEKARANG
function get_now() {
    date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.

    $tgl_sekarang = date("d-m-Y");
	
	return $tgl_sekarang;
}

//FUNGSI AMBIL TANGGAL DAN WAKTU SEKARANG
function datetime_now() {
    date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.

    $tgl_sekarang = date("d-m-Y");
    $jam_sekarang = date("H:i:s");

    return $tgl_sekarang.' '.$jam_sekarang;
}

if (!function_exists('format_year')) {

    function format_year($date, $sql = TRUE) {
        if ($sql == TRUE) {
            $year = substr($date, 0, 4);
        } else {
            //indonesian format
            $year = substr($date, 6, 4);
        }
        return $year;
    }

}

//FUNGSI NAMA BULAN
if (!function_exists('format_month')) {

    function format_month($month) {
        $indo_month = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        return $indo_month[$month];
    }

}

//FUNGSI FORMAT TANGGAL INDONESIA (12 Mei 2013)
if (!function_exists('format_date')) {

    function format_date($date) {
        $hari = substr($date, 0, 2);
        $bulan = substr($date, 3, 2);
        $tahun = substr($date, 6, 4);
        return $hari . ' ' . format_month($bulan) . ' ' . $tahun;
    }

}

//FUNGSI TANGGAL DARI SQL KE INDONESIA (2013-05-23 -> 23-05-2013)
if (!function_exists('format_sqltoindo')) {

    function format_sqltoindo($date) {
        $hari = substr($date, 8, 2);
        $bulan = substr($date, 5, 2);
        $tahun = substr($date, 0, 4);
        return $hari . '/' . $bulan . '/' . $tahun;
    }

}

//FORMAT INDONESIA TO SQL (23-05-2013 -> 2013-05-23, biasanya dipakai buat edit data)
if (!function_exists('format_indotosql')) {

    function format_indotosql($date) {
        $hari = substr($date, 0, 2);
        $bulan = substr($date, 3, 2);
        $tahun = substr($date, 6, 4);
        return $tahun . '-' . $bulan . '-' . $hari;
    }

}
//FORMAT TANGGAL DAN WAKTU SQL (2013-05-23 11:55:45) biasanya dipakai untuk edit data/tambah
if (!function_exists('format_datetime_sql')) {

    function format_datetime_sql($datetime) {
        $hari = substr($datetime, 0, 2);
        $bulan = substr($datetime, 3, 2);
        $tahun = substr($datetime, 6, 4);
        $jam = substr($datetime, 11, 2);
        $menit = substr($datetime, 14, 2);
        $detik = '00';
        return $tahun . '-' . $bulan . '-' . $hari . ' ' . $jam . ':' . $menit . ':' . $detik;
    }

}

//FORMAT TANGGAL DAN WAKTU SQL -> INDO (23 Mei 2013 11:55:45)
if (!function_exists('format_datetime_indo')) {

    function format_datetime_indo($datetime) {
        $hari = substr($datetime, 0, 2);
        $bulan = substr($datetime, 3, 2);
        $tahun = substr($datetime, 6, 4);
        $jam = substr($datetime, 11, 2);
        $menit = substr($datetime, 14, 2);
        $detik = substr($datetime, 17, 2);
        return $hari . '/' . $bulan . '/' . $tahun . ' ' . $jam . ':' . $menit . ':' . $detik;
    }

}
