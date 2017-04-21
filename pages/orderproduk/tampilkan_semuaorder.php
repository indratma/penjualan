<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT
			kodeorder
		FROM
			orderproduk
		WHERE kodeorder='001/PO/042017'";
$tampil	= mysql_query($text);
echo "<option value=''>- Silahkan Pilih -</option>";		 
while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kodeorder]>Buat SPK</option>";		 
}

?>