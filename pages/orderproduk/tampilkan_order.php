<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT
			a.kodeorder as kodeorder,
			a.tglorder AS tglorder,
			b.nama_barang as namabarang,
			a.jml as jumlah,
			c.nama_perusahaan as perusahaan,
			CONCAT(c.alamat, ' , ', c.kota) AS alamat
		FROM
			orderproduk a
		LEFT JOIN barang b ON b.kode_barang = a.kode_barang
		LEFT JOIN customer c ON c.kode_customer = a.kode_customer
		WHERE a.kodespm IS NULL
		ORDER BY
			kodeorder ASC";
$tampil	= mysql_query($text);
echo "<option value=''>- Silahkan Pilih -</option>";		 
while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kodeorder]>$r[kodeorder]</option>";		 
}

?>