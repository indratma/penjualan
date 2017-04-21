<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$text	="SELECT nik,nama FROM karyawan WHERE kode_divisi IN('202','206') AND tgl_keluar='0000-00-00' ORDER BY nama";
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);
$bank	= mysql_num_rows($tampil);

if($jml > 0){  
	echo "
	<option value='' selected>- Silahkan Pilih -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[nik]>$r[nama]</option>";	
	}	 
}

?>