<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_indotgl.php";

$username 	= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode 	= $rs[kodetrx];

$text 	= "SELECT b.kota,a.tglmohon FROM permintaan a
			LEFT JOIN perusahaan b ON b.kode_perusahaan=a.kodeperusahaan WHERE a.kodepermintaan='$kode'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kota 	= $rs[kota].', '.tgl_indo($rs[tglmohon]);
	

echo "
	<div class='col-xs-12 text-right'>
		<b>$kota</b>		
	</div>";                            
	
?>