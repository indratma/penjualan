<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";

$kode		= $_POST[kode];
$username 	= $_SESSION[namauser];

$upd = "UPDATE ordersewa SET kodecetak='1' WHERE kodeorder='$kode' ";
	mysql_query($upd);


?>