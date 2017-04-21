<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder	= $_POST[kodeorder];
$item		= $_POST[item];
$rpitem		= $_POST[rpitem];

$text	= "SELECT MAX(index_item) AS nourut FROM ordersewa_biayatambahan WHERE kodeorder='$kodeorder'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if($row>0){
	$rec		= mysql_fetch_array($sql);
	$nourut		= $rec[nourut];
	$kodeitem	= $nourut+1;
}else{
	$kodeitem	= "1";		
}

$input = "INSERT INTO ordersewa_biayatambahan(kodeorder,index_item,ket,rpbiaya) 
	VALUES ('$kodeorder','$kodeitem','$item','$rpitem')";

mysql_query($input);
echo "$input";
?>