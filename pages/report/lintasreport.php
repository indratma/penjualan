<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";

$tgl			= $_GET[tgl];
$customer		= $_GET[customer];
$username 		= $_SESSION[namauser];

if(empty($tgl)){
	$tgl1 = "";
	$tgl2 = date("d/m/Y");
}else{	
	$tgl1 = substr($tgl,0,10);
	$tgl2 = substr($tgl,13);
}	

$tgl1x 	= str_replace("/","-",$tgl1);
$tgl1 	= jin_date_sql($tgl1x);

$tgl2x 	= str_replace("/","-",$tgl2);
$tgl2 	= jin_date_sql($tgl2x);

$result = 0;


$hlink ='?mod=viewreport';
$idtrx = 'rptget';

$input = "DELETE FROM lintasreport WHERE userid='$username'";
mysql_query($input);

$input = "INSERT INTO lintasreport(kodeperusahaan,namaitem,armada,tglmulai,tglakhir,idtrx,userid) 
				VALUES('ITNS','$namaitem','$armada','$tgl1','$tgl2','$idtrx','$username')";	
mysql_query($input);

$result = 1;
		
$data['result'] = $result;
$data['hlink'] = $hlink;
echo json_encode($data);

?>