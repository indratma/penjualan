<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kdprshn 	= 'ITNS';

$text	="SELECT * FROM customer";
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);

if($jml > 0){  
	echo "
	<option value='' selected>- Customer -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[kode_customer]>$r[nama_customer]</option>";		 
     }
}else{
	echo "
	<option value='' selected>- Customer -</option>";
}	
?>