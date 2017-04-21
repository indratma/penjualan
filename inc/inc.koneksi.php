<?php
// $server = "192.168.2.222"; //
$server = "127.0.0.1"; //
$username = "root";  //
$password = "";
$database = "dbpenjualan";

$konek = mysql_connect($server, $username, $password) or die ("Gagal konek ke server Database" .mysql_error());
$bukadb = mysql_select_db($database) or die ("Gagal membuka database $database" .mysql_error());

?>