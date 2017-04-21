<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$text	="SELECT kodebank,namabank,no_rek,atas_nama FROM bank ORDER BY namabank";
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);
$bank	= mysql_num_rows($tampil);

if($jml > 0){  
	echo "
	<option value='' selected>- Nama Bank -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[kodebank]>$r[namabank]</option>";	
	}	 
}

?>