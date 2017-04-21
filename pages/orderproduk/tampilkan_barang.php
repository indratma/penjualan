<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT
			kode_barang,
			nama_barang,
			mesh
		  FROM
			barang
		  ORDER BY
			kode_barang ASC	";
$tampil	= mysql_query($text);
echo " <option value='' selected>- Silahkan Pilih -</option>";

while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kode_barang]>$r[nama_barang] | Mesh ($r[mesh])</option>";		 
}

?>