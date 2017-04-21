<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$kodeorder = $_GET[kodeorder];
$username 	= $_SESSION[namauser];

$text 	= "SELECT kodeperusahaan,kodeorder,idtrx FROM lintasreport WHERE userid='$username'";
$query 	= mysql_query($text);
$r 	= mysql_fetch_array($query);
$kdprshn 	= $r[kodeperusahaan];
$kodeorder 		= $r[kodeorder];
$idtrx 		= $r[idtrx];

	$text 	= "SELECT
						a.kodespm AS kodespm,
						a.kodeorder as kodeorder,
						DATE_FORMAT(a.tglorder, '%d/%m/%Y') AS tglorder,
						a.jml as jumlah,
						b.nama_perusahaan AS customer,
						CONCAT(b.alamat, ' , ', b.kota) AS alamat
					FROM
						orderproduk a
					INNER JOIN customer b ON b.kode_customer = a.kode_customer
					WHERE kodeorder='$kodeorder' ";
	$sql 	= mysql_query($text);	
	
	echo "
		<table class='table table-mod'>
		<tbody>";	
	
		$no=1;

		while($r = mysql_fetch_array($sql)){
			echo "
				<tr>
					<td class='text-right '>No. SPM</td>
					<td>&nbsp; : &nbsp;$r[kodespm]</td>                	
				</tr>
				<tr>
					<td class='text-right'>Nomor PO</td>
					<td>&nbsp; : &nbsp;$r[kodeorder]</td>
				</tr>
				<tr>
					<td class='text-right'>Tanggal Order</td>
					<td>&nbsp; : &nbsp;$r[tglorder]</td>
				</tr>
				<tr>
					<td class='text-right'>Tonase</td>
					<td>&nbsp; : &nbsp;$r[jumlah]&nbsp; Kg</td>
				</tr>
				<tr>
					<td class='text-right'>Pemesan</td>
					<td>&nbsp; : &nbsp;$r[customer]</td>
				</tr>
				<tr>
					<td class='text-right'>Tujuan</td>
					<td>&nbsp; : &nbsp;$r[alamat]</td>
				</tr>";					
			$no++;						
		}	
	echo "	</tbody>
			</table>";
	

?>