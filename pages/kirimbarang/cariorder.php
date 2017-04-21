<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder		= $_POST[kodeorder];
$username 		= $_SESSION[namauser];

$text	= "SELECT
			a.kodeorder as kodeorder,
			b.nama_perusahaan as perusahaan,
			CONCAT(b.alamat, ' , ', b.kota) AS alamat
		FROM
			orderproduk a
		LEFT JOIN customer b ON b.kode_customer = a.kode_customer
		WHERE kodeorder='$kodeorder'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['perusahaan']	= $r[perusahaan];
		$data['alamat']		= $r[alamat];
		echo json_encode($data);
	}		
}else{
		$data['perusahaan']		= $r[''];
		$data['alamat']			= $r[''];
		echo json_encode($data);	
}

?>