<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];

$text 	= "SELECT kodeperusahaan,kodeorder,idtrx
			FROM lintasreport WHERE userid='$username'";
$query 	= mysql_query($text);
$r 	= mysql_fetch_array($query);
$kdprshn 	= $r[kodeperusahaan];
$kodeorder 		= $r[kodeorder];
$idtrx 		= $r[idtrx];

echo "
	<div class='col-xs-12 text-center'>
		<h4><b><u>
			Surat Perintah Kerja
		</u></b></h4>";
?>