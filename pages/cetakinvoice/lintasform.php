<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kode		= $_POST[kode];
$username 	= $_SESSION[namauser];


$result = 0;

$del = "DELETE FROM lintasform WHERE userid='$username'";
mysql_query($del);

$input = "INSERT INTO lintasform(kodetrx,userid,tgl,idtrx) 
			VALUES('$kode','$username',SYSDATE(),'prevp')";	
mysql_query($input);
$result = 1;
$data['result'] = $result;
echo json_encode($data);

/*if ($result=1){
$upd = "UPDATE ordersewa SET kodecetak='1' WHERE kodeorder='$kode' ";
	mysql_query($upd);	
}
*/?>