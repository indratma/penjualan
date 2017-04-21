<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$kodeorder = $_GET[kodeorder];
$username 	= $_SESSION[namauser];

$text 	= "SELECT kodeorder,idtrx FROM lintasreport WHERE userid='$username'";
$query 	= mysql_query($text);
$r 	= mysql_fetch_array($query);
$kdprshn 	= $r[kodeperusahaan];
$kodeorder 		= $r[kodeorder];
$idtrx 		= $r[idtrx];

$text 	= "SELECT
	a.kodespk AS kode,
	a.kodeorder AS kodeorder,
	b.produk AS produk,
	b.berat AS berat,
	b.karung AS karung,
	b.karungtot AS karungtot,
	b.total AS total,
	b.ket AS ket
FROM
	orderproduk a
LEFT JOIN spk b ON b.kodespk = a.kodespk
WHERE
	a.kodeorder = '$kodeorder' ";
	$sql 	= mysql_query($text);	
	
	echo "
		<table class='table table-bordered'>";	
	
		$no=1;

		while($r = mysql_fetch_array($sql)){
			echo "
				<tr>
				<th width='8%' height='80' rowspan='2' class='text-center'>
		No</th>
		<th class='text-center' rowspan='2'>DESCRIPTION</th>
		<th class='text-center' colspan='2'>UNIT QUANTITY</th>
		<th class='text-center' colspan='2'>Total Quantity</th>
	</tr>
	<tr>
		<th class='text-center'>Kg</th>
		<th class='text-center'>Karung</th>
		<th class='text-center' width='20%'>Jumlah Karung</th>
		<th class='text-center'>Tonase</th>
	</tr>
	<tr>
		<td class='text-center' height='69'>$no</td>
		<td class='text-center'>
		$r[produk]</td>
		<td class='text-center'>
		$r[berat]</td>
		<td class='text-center'>
		$r[karung]</td>
		<td class='text-center'>
		$r[karungtot]</td>
		<td class='text-center'>
		$r[total]&nbsp; Kg</td>
	</tr>
	<tr>
		<td width='55%' height='69' colspan='4'></td>
		<td class='text-center'>
		$r[karungtot]</td>
		<td class='text-center'>
		$r[total]&nbsp; Kg</td>
	</tr>";					
			$no++;						
		}	
	echo "</table>";
	

?>