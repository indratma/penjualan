<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$prhsn		= $_POST[kdprshn];
$username 		= $_SESSION[namauser];

$text	= "SELECT kodeperusahaan,namaperusahaan,CONCAT(alamat,' , ',kota) AS alamat
		   FROM perusahaan WHERE kodeperusahaan='$prhsn'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['alamat']			= $r[alamat];
		echo json_encode($data);
	}		
}else{
		$data['alamat']			= $r[''];
		echo json_encode($data);	
}

?>