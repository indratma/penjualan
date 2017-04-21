<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kdprshn 	= 'ITNS';

$text	="SELECT nopol,namaarmada FROM armada";
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);

if($jml > 0){  
	echo "
	<option value='' selected>- ALL -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[nopol]>$r[namaarmada]</option>";		 
     }
}else{
	echo "
	<option value='' selected>- ALL -</option>";
}	
?>