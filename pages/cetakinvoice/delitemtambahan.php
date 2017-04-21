<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder	  = $_POST[kodeorder];
$kodeitem	  = $_POST[kodeitem];

$username	  = $_SESSION[namauser];


$del	= "DELETE FROM ordersewa_biayatambahan WHERE kodeorder='$kodeorder'  AND index_item='$kodeitem'";
mysql_query($del);

echo $del;

?>