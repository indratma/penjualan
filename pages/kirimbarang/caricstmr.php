<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$customer		= $_POST[kdcustomer];
$username 		= $_SESSION[namauser];

$text	= "SELECT kode_customer,nama_customer,nama_perusahaan,CONCAT(alamat,' , ',kota) AS alamat,CONCAT(notelp,' / ',nohp) AS telp
			FROM customer WHERE kode_customer='$customer'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['nama_customer']	= $r[nama_customer];
		$data['alamat']			= $r[alamat];
		$data['telp']			= $r[telp];
		echo json_encode($data);
	}		
}else{
		$data['nama_customer']	= $r[''];
		$data['alamat']			= $r[''];
		$data['telp']			= $r[''];
		echo json_encode($data);	
}

?>