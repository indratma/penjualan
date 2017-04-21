<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];
$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";					
$sql 	= mysql_query($text);	
$rec 	= mysql_fetch_array($sql);

$kode			= $rec[kodetrx];
$bank			= $_POST[kodebank];
$username 		= $_SESSION[namauser];

$text	= "SELECT b.kodebank,a.namabank,a.no_rek,a.atas_nama FROM bank a LEFT JOIN ordersewa b
			 ON a.kodebank=b.kodebank WHERE b.kode_customer='$kode'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['namabank']		= $r[namabank];
		$data['norekbank']		= $r[no_rek];
		$data['penerima']		= $r[atas_nama];
		echo json_encode($data);
	}		
}else{
		$data['namabank']		= $r[''];
		$data['norekbank']			= $r[''];
		$data['penerima']		= $r[''];
		echo json_encode($data);	
}

?>