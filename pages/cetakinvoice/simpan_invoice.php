<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$kdbank			= $_POST[bank];
$nopol			= $_POST[kodearmada];
$suratjalan		= $_POST[suratjalan];
$jml			= $_POST[jml];
$kodesatuan		= $_POST[kodesatuan];
$rpbiaya		= $_POST[biayasewa];
$sistemsewa		= $_POST[sistemsewa];
$pencetak		= $_POST[pencetak];
$noinvoice		= $_POST[noinvoice];
$username 		= $_SESSION[namauser];

if ($sistemsewa==1 and $kodesatuan==2){
	$subtot = $jml*$rpbiaya*1000;
}elseif ($sistemsewa==1 and $kodesatuan==1){
	$subtot = $jml*$rpbiaya;	
}else{
	$subtot = $rpbiaya;
}

$text		= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$sql		= mysql_query($text);
$ada		= mysql_num_rows($sql);
$rec 		= mysql_fetch_array($sql);
$kodetrx	= $rec[kodetrx];

$txt		= "SELECT CONCAT(SUBSTR(namaarmada,'1','1'),SUBSTR(namaarmada,'9','2')) AS armada FROM armada WHERE nopol='$nopol'";
$s			= mysql_query($txt);
$rs 		= mysql_fetch_array($s);
$armada		= $rs[armada];

$text	= "SELECT DATE_FORMAT(tglmuat,'%Y-%m') AS bulanmuat FROM ordersewa WHERE kodeorder='$kodetrx'";
$sql	= mysql_query($text);
$rec 	= mysql_fetch_array($sql);
$bulanmuat = $rec[bulanmuat]; 

$text	= "SELECT MAX(LEFT(noinvoice,3)) AS nourut FROM ordersewa WHERE DATE_FORMAT(tglmuat,'%Y-%m')='$bulanmuat'";
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


$text	= "SELECT DATE_FORMAT(tglmuat,'%m') AS month FROM ordersewa WHERE kodeorder='$kodetrx'";
$sql	= mysql_query($text);
$rec 	= mysql_fetch_array($sql);
$month = $rec[month];

$text	= " SELECT SUBSTR(DATE_FORMAT(tglmuat,'%Y'),3,2) AS year FROM ordersewa WHERE kodeorder='$kodetrx'";
$sql	= mysql_query($text);
$rec 	= mysql_fetch_array($sql);
$year = $rec[year];

if(empty($noinvoice)){

	$noinvoice 		= sprintf("%03s",$nourut).'/'.$armada.'/'.$month.'/'.$year;

}

		
$update		= "UPDATE ordersewa SET noinvoice='$noinvoice',jml='$jml',biayasewa='$rpbiaya',subtot='$subtot',
			kodebank='$kdbank',suratjalan='$suratjalan', pencetak='$pencetak' 
			WHERE kodeorder='$kodetrx' and kodebongkar='1'";
mysql_query($update);
	
$insert2	= "INSERT INTO suratjalan (noinvoice,suratjalan) VALUES ('$noinvoice','$suratjalan'";
mysql_query($insert2);

$insert		= "INSERT INTO pelunasanpiutang (kodetrx,kodeorder,noinvoice,jmlrp,kodecustomer) VALUES ('$kodetrx','$kodetrx','$noinvoice',-($rpbiaya),'$kdcustomer')";
mysql_query($insert);
	

$dexl = "DELETE FROM lintasform WHERE userid='$username'";
mysql_query($delx);
	
echo "<h4>Data sukses di simpan. No Invoice = $noinvoice </h4>";

?>