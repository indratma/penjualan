<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode 	= $rs[kodetrx];

$text	= "SELECT
			a.kodeorder,
			DATE_FORMAT(a.tglorder, '%d/%m/%Y') AS tglorder,
			a.namabrg,
			a.jml as jumlah,
			b.nama_customer AS customer,
			CONCAT(b.alamat, ' , ', b.kota) AS  alamat
		FROM
			orderproduk a
		LEFT JOIN customer b ON b.kode_customer = a.kode_customer
		WHERE a.kodeorder='$kode' ";
			
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		
		$data['ada']		= $jmlrec;
		$data['tglorder']	= $r[tglorder];
		$data['namabrg']	= $r[namabrg];
		$data['customer']	= $r[customer];
		$data['jml']		= $r[jml];
		$data['alamat']		= $r[alamat];
		echo json_encode($data);
	}		
}else{
		$data['ada']		= $jmlrec;
		$data['tglorder']		= '';
		$data['namabrg']	= '';
		$data['customer']	= '';
		$data['jml']	= '';
		$data['alamat']	= '';
		echo json_encode($data);	
}
	
?>