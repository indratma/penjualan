<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_terbilang.php";

$username 	= $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM sj WHERE idtrx='printsj' ORDER BY idspj DESC";
$sql 	= mysql_query($text);
$tampil = mysql_fetch_array($sql);
$kode 	= $tampil[kodetrx];

$text 	= "SELECT
				a.kodeorder AS kodeorder,
				a.kodekirim AS kodekirim,
				b.nama_barang AS barang,
				CONCAT(c.jml,' ','Kg') AS jml,
				c.kendaraan AS kendaraan,
				c.nopol AS nopol,
				d.namaperusahaan AS pabrik,
				CONCAT(d.alamat, ',', d.kota) AS alamat,
				d.email AS email,
				d.website AS web,
				e.nama_perusahaan AS customer,
				CONCAT(e.alamat, ',', e.kota) AS tujuan,
				c.ket as ket
			FROM
				orderproduk a
			LEFT JOIN barang b ON b.kode_barang = a.kode_barang
			LEFT JOIN pengiriman c ON c.kodeorder = a.kodeorder
			LEFT JOIN perusahaan d ON d.kodeperusahaan = c.kodeperusahaan
			LEFT JOIN customer e ON e.kode_customer = a.kode_customer
			WHERE
				a.kodeorder = '$kode'";
$sql 	= mysql_query($text);


while($tampil = mysql_fetch_array($sql)) {
	
	$data['kodekirim'] 		= $tampil['kodekirim'];
	$data['kendaraan']	 	= $tampil['kendaraan'];
	$data['nopol'] 			= $tampil['nopol'];
	$data['barang'] 		= $tampil['barang'];
	$data['jml'] 			= $tampil['jml'];
	$data['pabrik'] 		= $tampil['pabrik'];
	$data['alamat'] 		= $tampil['alamat'];
	$data['email']	 		= $tampil['email'];
	$data['web'] 			= $tampil['web'];
	$data['customer'] 		= $tampil['customer'];
	$data['tujuan']			= $tampil['tujuan'];
	$data['ket'] 			= $tampil['ket'];
	
}
	echo json_encode($data);

?>