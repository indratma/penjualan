<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_koma.php";
$username 		= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username' AND idtrx='prevp'";
$sql 	= mysql_query($text);
$tampil = mysql_fetch_array($sql);
$kode 	= $tampil[kodetrx];


$text 	= "SELECT ket, rpbiaya FROM ordersewa_biayatambahan WHERE kodeorder='$kode'";
$sql 	= mysql_query($text);
	
$jmlrec	= mysql_num_rows($sql);

if ($jmlrec > 0){
echo "
<table class='table'>";
	
	$no=1;
	while($rec = mysql_fetch_array($sql)){
	echo "	
		<tr>
			<td>$rec[ket]</td>
            <td class='text-right'>Rp ".number_format($rec[rpbiaya],'0',',','.')."</td>
		</tr>
		";
		$no++;						
		}
		
	echo"
		<tr>
			<td></td>
            <td></td>
		</tr>
</table>";

}

	
?>