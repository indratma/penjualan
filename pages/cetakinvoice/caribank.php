<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$bank			= $_POST[kodebank];
$username 		= $_SESSION[namauser];

$text	= "SELECT kodebank,namabank,no_rek,atas_nama FROM bank 
			 WHERE kodebank='$bank'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['namabank']		= $r[namabank];
		$data['no_rek']			= $r[no_rek];
		$data['atas_nama']		= $r[atas_nama];
		echo json_encode($data);
	}		
}else{
		$data['namabank']	= $r[''];
		$data['no_rek']			= $r[''];
		$data['atas_nama']		= $r[''];
		echo json_encode($data);	
}

?>