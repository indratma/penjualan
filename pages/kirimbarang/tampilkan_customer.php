<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT kode_customer,nama_customer,nama_perusahaan FROM customer WHERE onview='1' ORDER BY nama_perusahaan ASC";
$tampil	= mysql_query($text);
echo " <option value='' selected>- Silahkan Pilih -</option>";

while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kode_customer]>$r[nama_perusahaan]</option>";		 
}

?>