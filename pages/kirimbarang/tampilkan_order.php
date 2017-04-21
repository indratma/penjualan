<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT
				a.kodeorder AS kodeorder,
				b.nama_perusahaan AS perusahaan,
				a.jml,
				SUM(c.jml) as jml2,
				CONCAT(b.alamat, ' , ', b.kota) AS alamat
			FROM
				orderproduk a
			LEFT JOIN customer b ON b.kode_customer = a.kode_customer
			LEFT JOIN pengiriman c ON c.kodeorder = a.kodeorder
			WHERE
				a.kodespm IS NOT NULL
			GROUP BY
				a.kodeorder
			HAVING SUM(c.jml)<a.jml OR SUM(c.jml)<a.jml is NULL
			ORDER BY
				kodeorder ASC";
$tampil	= mysql_query($text);
echo "<option value=''>- Silahkan Pilih -</option>";		 
while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kodeorder]>$r[kodeorder]</option>";		 
}

?>