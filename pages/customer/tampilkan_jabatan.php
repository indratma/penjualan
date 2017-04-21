<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT kode_jabatan,namajabatan FROM jabatan ORDER BY kode_jabatan";
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);

	echo " <option value='' selected>- Silahkan Pilih -</option>";
	
     while($r=mysql_fetch_array($tampil)){
	 
         echo "<option value=$r[kode_jabatan]>$r[namajabatan]</option>";		 
     }

?>