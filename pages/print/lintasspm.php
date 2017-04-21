<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";

$kodeorder		= $_GET[kodeorder];
$username 		= $_SESSION[namauser];

$result = 0;


$hlink ='?mod=printspm';
$idtrx = 'rptget';

$input = "DELETE FROM lintasreport WHERE userid='$username'";
mysql_query($input);


$input = "INSERT INTO lintasreport(kodeperusahaan,kodeorder,idtrx,userid) 
				VALUES('ITRD','$kodeorder','$idtrx','$username')";	
mysql_query($input);



$result = 1;
		
$data['result'] = $result;
$data['hlink'] = $hlink;
echo json_encode($data);

?>