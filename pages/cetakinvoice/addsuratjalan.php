<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$kodeorder	= $_POST[kodeorder];
$suratjalan	= $_POST[suratjalan];

$text	= "SELECT MAX(index_sj) AS nourut FROM suratjalan WHERE kodeorder='$kodeorder'";
$sql 	= mysql_query($text);
$row	= mysql_num_rows($sql);
if($row>0){
	$rec = mysql_fetch_array($sql);
	$nourut = $rec[nourut];
	$nourut	= $nourut+1;
}else{
	$nourut	= "1";		
	}
	
$input = "INSERT INTO suratjalan(kodeorder,index_sj,nosuratjalan) 
	VALUES ('$kodeorder','$nourut','$suratjalan')";

mysql_query($input);
echo "$input";
?>