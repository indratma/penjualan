<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];

$text 	= "SELECT kodeperusahaan,DATE_FORMAT(tglmulai,'%d/%m/%Y') AS tglmulai,DATE_FORMAT(tglakhir,'%d/%m/%Y') AS tglakhir,idtrx,armada 
			FROM lintasreport WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kdprshn 	= $rs[kodeperusahaan];
$tgl1 		= $rs[tglmulai];
$tgl2 		= $rs[tglakhir];
$idtrx 		= $rs[idtrx];

echo "
	<div class='col-xs-12 text-center'>
		<h4><b><u>
			History Pemakaian Barang 
		</u></b></h4>";
	
		if(empty($tgl1)){
			echo " <br></div>"; 
		}else{
			echo "
			Tgl. $tgl1 - $tgl2					
			</div>";
		}	
	
?>