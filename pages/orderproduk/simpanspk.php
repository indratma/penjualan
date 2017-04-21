<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$kodeorder		= $_POST[kodeorder];
$produk			= $_POST[produk];
$karungtot		= $_POST[karungtot];
$berat			= $_POST[berat];
$ket			= $_POST[ket];
$username 		= $_SESSION[namauser];


$total = $karungtot * $berat;
if($ada==0){
		$text	= "SELECT MAX(LEFT(kodespk,2)) AS nourut FROM spk";
		$sql	= mysql_query($text);
		$row	= mysql_num_rows($sql);
		if($row>0){
			$rec = mysql_fetch_array($sql);
			$nourut = $rec[nourut]+1;
			if($nourut>999){
				$nourut=1;
			}	 		
		}else{
			$nourut=1;	
		}
	
	$text	= "SELECT DATE_FORMAT(SYSDATE(),'%m-%Y') AS blnskg FROM DUAL";
	$sql	= mysql_query($text);
	$rec 	= mysql_fetch_array($sql);
	$blnskg = $rec[blnskg];

	//$kode 		= sprintf("%03s",$nourut).'.SPK.'.$blnskg;
	$kode 		= sprintf("%02s",$nourut).'.'."SPK".'.'.$blnskg;
			
	$input = "INSERT INTO spk(
							kodespk,
							kodeorder,
							produk,
							karung,
							berat,
							karungtot,
							total,
							ket,
							userid,
							tglentry
							)
				VALUES('$kode', 
						'$kodeorder',
						'$produk',
						'1',
						'$berat',
						'$karungtot',
						'$total',
						'$ket',
						'$username',
						SYSDATE()
						)";
	mysql_query($input);
var_dump($input);die;
	//echo "<h4>Simpan Data Sukses,</p> No Purchase Order Anda : <h4>".$kodeorder."</h4>";
	
}else{
	
	echo "gagal";
}	


?>