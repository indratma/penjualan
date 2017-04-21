<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username 	= $_SESSION[namauser];
$kodeorder 	= $_GET[kodeorder];

$text 	= "SELECT
				a.kodeorder as kodeorder,
				b.ket as ket,
				a.idtrx as idtrx
			FROM
				lintasreport a
			LEFT JOIN spk b ON b.kodeorder = a.kodeorder
			WHERE
				a.userid = '$username'";
$query 	= mysql_query($text);
$r 	= mysql_fetch_array($query);
$kodeorder 		= $r['kodeorder'];
$idtrx 		= $r['idtrx'];
$ket	= $r['ket'];
echo "
	<div class=''> 
		<p><h5></i>Ket &nbsp;:&nbsp;$ket</h5></p>
	</div>";                            
	
?>