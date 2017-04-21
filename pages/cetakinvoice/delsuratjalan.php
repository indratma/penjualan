<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder	  = $_POST[kodeorder];
$suratjalan	  = $_POST[suratjalan];

$username	  = $_SESSION[namauser];


$del	= "DELETE FROM suratjalan WHERE kodeorder='$kodeorder'  AND index_sj='$suratjalan'";
mysql_query($del);

echo $del;

?>