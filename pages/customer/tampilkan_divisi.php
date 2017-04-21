<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT kode_divisi,namadivisi FROM divisi ORDER BY kode_divisi";
$tampil	= mysql_query($text);

	echo " <option value='' selected>- Silahkan Pilih -</option>";
	
     while($r=mysql_fetch_array($tampil)){
	 
         echo "<option value=$r[kode_divisi]>$r[namadivisi]</option>";		 
     }

?>