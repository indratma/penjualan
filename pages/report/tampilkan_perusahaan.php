<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kdprshn_user =$_SESSION[kodeprshn];

if($kdprshn_user=="ITNS"){
	$text	= "SELECT kode_perusahaan,namaperusahaan FROM perusahaan ORDER BY namaperusahaan";		
	
}else{
	$text	="SELECT kode_perusahaan,namaperusahaan FROM perusahaan WHERE kode_perusahaan='$kdprshn_user'";
}
$tampil	= mysql_query($text);
$jml	= mysql_num_rows($tampil);

if($jml > 0){  
	echo "
	<option value='' selected>- All -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value=$r[kode_perusahaan]>$r[namaperusahaan]</option>";		 
     }
}
?>