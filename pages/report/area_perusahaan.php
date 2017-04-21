<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];


$text 	= "SELECT tampilanlain,alamat,notelp FROM perusahaan WHERE kode_perusahaan='ITNS'";
$sql 	= mysql_query($text);	
$rec 	= mysql_fetch_array($sql);
$namaperusahaan = $rec['tampilanlain'];
$alamat 		= $rec['alamat'];
$notelp	 		= $rec['notelp'];

echo "
	<div class='page-header'> 
		<p><h4><i class='fa fa-globe'></i>&nbsp;<b>$namaperusahaan</b></h4></p>
		<p><h5></i>&nbsp;$alamat</h5></p>
		<p><h5></i>&nbsp;$notelp</h5></p>
		
	</div>";                            
	
?>