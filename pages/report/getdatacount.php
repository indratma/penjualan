<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];

$text	= "SELECT kodebrg FROM pembelian a LEFT JOIN pembelian_detail b ON b.kodepembelian=a.kodepembelian WHERE userid='$username'";
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

$data['jmlrec'] = $jmlrec;
echo json_encode($data);
	
?>