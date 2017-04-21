<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kode		= $_POST[kode];
$username 	= $_SESSION[namauser];

$result = 0;

$input = "DELETE FROM lintasform WHERE userid='$username' AND idtrx='prevnik'";
mysql_query($input);

$input = "INSERT INTO lintasform(kodetrx,userid,tgl,idtrx) 
			VALUES('$kode','$username',SYSDATE(),'prevnik')";	
mysql_query($input);
$result = 1;
		
$data['result'] = $result;
echo json_encode($data);

?>