<?php
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_tanggal.php";

$kode		= $_POST[kode];

$upd = "DELETE FROM ordersewa WHERE kodeorder='$kode'";
mysql_query($upd);	

$upd = "DELETE FROM logperjalanan WHERE kodeorder='$kode'";
mysql_query($upd);
	
echo $upd;

?>