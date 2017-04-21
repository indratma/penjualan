<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_terbilang.php";

$moneyFormat 	= new moneyFormat();
$username 	= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username' AND idtrx='prevp'";
$sql 	= mysql_query($text);
$tampil = mysql_fetch_array($sql);
$kode 	= $tampil[kodetrx];

$text 	= "SELECT a.noinvoice,DATE_FORMAT(a.tglorder,'%d/%m/%Y') AS tglorder,
			DATE_FORMAT(SYSDATE(),'%d/%m/%Y') AS tglinvoice,
			b.alamat,b.kota,b.notelp,b.nohp,a.namabrg,a.armada,b.nama_perusahaan,a.kotaasal,c.nama AS kotaasal,
			d.nama AS kotatujuan,DATE_FORMAT(a.tglmuat,'%d/%m/%Y') AS tglmuat,DATE_FORMAT(a.tglbongkar,'%d/%m/%Y') AS tglsampai,
			IF(RIGHT(a.jml,2)=0,LEFT(a.jml,LENGTH(a.jml)-3),IF(RIGHT(a.jml,1)=0,LEFT(a.jml,LENGTH(a.jml)-1),a.jml)) 
			AS jml,IF(a.kodesatuan=1,'Kg','Ton') AS satuan,a.biayasewa,a.subtot,e.nama AS marketing,f.catatan, 
			g.nama AS pencetak 
			FROM ordersewa a 
			LEFT JOIN customer b ON a.kode_customer=b.kode_customer 
			LEFT JOIN karyawan e ON e.nik=a.marketing
			LEFT JOIN kota c ON c.kode=a.kotaasal 
			LEFT JOIN kota d ON d.kode=a.kotatujuan
			LEFT JOIN bank f ON a.kodebank=f.kodebank 
			LEFT JOIN karyawan g ON g.nik=a.pencetak 
			WHERE a.kodeorder='$kode'";
$sql 	= mysql_query($text);

$text2 	= "SELECT ket, rpbiaya FROM ordersewa_biayatambahan WHERE kodeorder='$kode'";
$sql2 	= mysql_query($text2);

$text3 		= "SELECT SUM(rpbiaya) AS tambahan FROM ordersewa_biayatambahan WHERE kodeorder='$kode'";
$sql3 		= mysql_query($text3);
$rec3 		= mysql_fetch_array($sql3);
$tambahan 	= $rec3[tambahan];

$text4 		= "SELECT subtot FROM ordersewa WHERE kodeorder='$kode'";
$sql4 		= mysql_query($text4);
$rec4 		= mysql_fetch_array($sql4);
$subtot 	= $rec4[subtot];

$grandtot	= $subtot+$tambahan;
$terbilang 	= $moneyFormat->terbilang($grandtot); 

while($tampil = mysql_fetch_array($sql)) {
	
	$data['kodeinvoice'] 	= $tampil['noinvoice'];
	$data['tglinvoice'] 	= $tampil['tglinvoice'];
	$data['marketing'] 		= $tampil['marketing'];
	$data['alamat'] 		= $tampil['alamat'];
	$data['kota'] 			= $tampil['kota'];
	$data['notelp'] 		= $tampil['notelp'];
	$data['nohp'] 			= $tampil['nohp'];
	$data['tglorder'] 		= $tampil['tglorder'];
	$data['namabrg'] 		= $tampil['namabrg'];
	$data['armada'] 		= $tampil['armada'];
	$data['nama_perusahaan']= $tampil['nama_perusahaan'];
	$data['kotaasal'] 		= $tampil['kotaasal'];
	$data['kotatujuan'] 	= $tampil['kotatujuan'];
	$data['tglmuat'] 		= $tampil['tglmuat'];
	$data['tglsampai'] 		= $tampil['tglsampai'];
	$data['berat'] 			= $tampil['jml']." ".$tampil['satuan'];
	$data['biayasewa'] 		= "Rp ".number_format($tampil['biayasewa'],'0',',','.');
	$data['total'] 			= "Rp ".number_format($tampil['total'],'0',',','.');
	$data['subtot']			= "Rp ".number_format($tampil['subtot'],'0',',','.');
	$data['grandtot']		= "Rp ".number_format($grandtot,'0',',','.');
	$data['terbilang']		= "$terbilang Rupiah";
	$data['catatan']		= $tampil[catatan];
	$data['pencetak']		= $tampil[pencetak];
	
}
while($tampil = mysql_fetch_array($sql2)) {
	$data['itemtambahan']	= $tampil[ket];
	$data['rpitemtambahan']	= "Rp ".number_format($tampil['rpbiaya'],'0',',','.');
	
}
	echo json_encode($data);

?>