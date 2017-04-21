<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder		= $_POST[kodeorder];
$username 		= $_SESSION[namauser];

$text	= "SELECT
			a.kodeorder as kodeorder,
			a.tglorder AS tglorder,
			b.nama_barang as namabarang,
			CONCAT(a.jml, ' Kg ') AS jumlah,
			c.nama_perusahaan as perusahaan,
			CONCAT(c.alamat, ' , ', c.kota) AS alamat
		FROM
			orderproduk a
		LEFT JOIN barang b ON b.kode_barang = a.kode_barang
		LEFT JOIN customer c ON c.kode_customer = a.kode_customer
		WHERE kodeorder='$kodeorder'";
$sql 	= mysql_query($text) or die(mysql_error());
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		$data['tglorder']	= $r[tglorder];
		$data['namabarang']	= $r[namabarang];
		$data['jumlah']		= $r[jumlah];
		$data['perusahaan']	= $r[perusahaan];
		$data['alamat']		= $r[alamat];
		echo json_encode($data);
	}		
}else{
		$data['tglorder']		= $r[''];
		$data['nama_barang']	= $r[''];
		$data['jumlah']			= $r[''];
		$data['perusahaan']		= $r[''];
		$data['alamat']			= $r[''];
		echo json_encode($data);	
}

?>