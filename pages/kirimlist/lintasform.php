<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kode		= $_POST[kode];
$username 	= $_SESSION[namauser];

$result = 0;

$del = "DELETE FROM sj WHERE kodetrx='$kode'";
mysql_query($del);

$input = "INSERT INTO sj(idspj,kodetrx,idtrx) 
			VALUES('NULL','$kode','printsj')";	
mysql_query($input);
$result = 1;
$data['result'] = $result;
echo json_encode($data);

/*if ($result=1){
$upd = "UPDATE ordersewa SET kodecetak='1' WHERE kodeorder='$kode' ";
	mysql_query($upd);	
}
*/?>