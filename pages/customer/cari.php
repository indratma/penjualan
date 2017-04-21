<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode = $rs[kodetrx];

$text	= "SELECT kode_customer,nama_customer,nama_perusahaan,alamat,kota,notelp,nohp,ket FROM customer WHERE kode_customer='$kode'";
			
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){			
		$data['kode_customer']	= $r[kode_customer];
		$data['nama_customer']	= $r[nama_customer];	
		$data['nama_perusahaan']	= $r[nama_perusahaan];	
		$data['alamat']			= $r[alamat];
		$data['kota']			= $r[kota];
		$data['notelp']			= $r[notelp];
		$data['nohp']			= $r[nohp];
		$data['ket']			= $r[ket];
		echo json_encode($data);
	}		
}else{
		$data['kode_customer']	= '';
		$data['nama_customer']	= '';
		$data['nama_perusahaan']= '';		
		$data['alamat']			= '';
		$data['kota']			= '';
		$data['notelp']			= '';
		$data['nohp']			= '';
		$data['ket']			= '';
		echo json_encode($data);	
}
	
?>