<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];
$kodeorder 	= $_GET[kodeorder];

$text 	= "SELECT
				a.kodeorder as kodeorder,
				b.kodespk as kodespk,
				a.idtrx as idtrx
			FROM
				lintasreport a
			LEFT JOIN orderproduk b ON b.kodeorder = a.kodeorder
			WHERE
				a.userid = '$username'";
$query 	= mysql_query($text);
$r 	= mysql_fetch_array($query);
$kodeorder 		= $r['kodeorder'];
$idtrx 		= $r['idtrx'];
$kodespk	= $r['kodespk'];
echo "
	<div class=''> 
		<p><h5><i><b>No&nbsp;SPK &nbsp;:&nbsp;$kodespk</h></p></i>
		<hr style='border: 1px solid #000000;'>
	</div>";                            
	
?>