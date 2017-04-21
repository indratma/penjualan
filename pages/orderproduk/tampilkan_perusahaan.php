<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT kodeperusahaan,namaperusahaan FROM perusahaan ORDER BY namaperusahaan ASC";
$tampil	= mysql_query($text);
echo " <option value='' selected>- Silahkan Pilih -</option>";

while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kode_perusahaan]>$r[namaperusahaan]</option>";		 
}

?>