<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$bank		= strtoupper($_POST[bank]);
$norek		= $_POST[norek];
$ownrek		= $_POST[ownrek];

$text	= "SELECT MAX(RIGHT(kodebank,4)) AS nourut FROM bank";
		$sql 	= mysql_query($text);
		$row	= mysql_num_rows($sql);
		if($row>0){
			$rec = mysql_fetch_array($sql);
			$nourut = $rec[nourut]+1;
			if($nourut>9999){
				 $nourut=1;
			}	 		
		}else{
			$nourut=1;	
		}
		
		$sql 	= mysql_query($text);
		$rec	= mysql_fetch_array($sql);
		$kode	= "B".sprintf("%04s",$nourut);
		
$text		="SELECT kodebank,namabank FROM bank WHERE namabank='$bank'";
$sql		= mysql_query($text);
$jmlrec		= mysql_num_rows($sql);

if($bank==$namabank){
	echo "Maaf Data Nama Bank Sudah Ada!!!";
	
}else if($jmlrec==0){
$input = "INSERT INTO bank(kodebank,namabank,no_rek,atas_nama,catatan) VALUES('$kode','$bank','$norek','$ownrek','Pembayaran untuk invoice ini mohon ditransfer ke: 
Bank'  
'$namabank' 
'a/n' 
'$atas_nama'
'$norek')";	
mysql_query($input) or die (mysql_error());
	echo "Input Berhasil.";
}else{
	echo "Input gagal.";
}	

?>