<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";


$text	="SELECT
				kodeperusahaan,
				namaperusahaan
			FROM
				perusahaan
			WHERE
				kodeperusahaan ='SMTH' OR index_perusahaan ='3'
			ORDER BY
				namaperusahaan ASC";
$tampil	= mysql_query($text);
echo " <option value='' selected>- Silahkan Pilih -</option>";

while($r=mysql_fetch_array($tampil)){
 	echo "<option value=$r[kodeperusahaan]>$r[namaperusahaan]</option>";		 
}

?>