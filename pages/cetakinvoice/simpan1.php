<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";

$kdcustomer		= $_POST[kodecustomer];
$tglbayar 		= $_POST[tglbayar];
$sistembyr		= $_POST[sistembyr];
$banktujuan		= $_POST[banktujuan];
$norektujuan 	= $_POST[norektujuan];
$pemilikrek		= $_POST[pemilikrek];
$jmlbayar 		= $_POST[jmlbayar];
$username 		= $_SESSION[namauser];
$kdprshn		= 'ITNS';

$result = "Simpan data gagal";

$tglbayarx 	= str_replace("/","-",$tglbayar);
$tglbayar	= jin_date_sql($tglbayarx);	

$panjang = strlen($jmlbayar);
$i=0;
$jml_tmp='';
while($i <= $panjang){
	$a = substr($jmlbayar,$i,1);
	if($a=='.'){
		$a='';		
	}elseif($a==','){	
		$a='.';		
	}	
	$jml_tmp = $jml_tmp . $a;
	$i++;
}
$jmlbayar = $jml_tmp;


$text	= "SELECT MAX(LEFT(kodebayar,3)) AS nourut FROM pembayarancustomer";
$sql 	= mysql_query($text);
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

$text	= "SELECT DATE_FORMAT(SYSDATE(),'%m%Y') AS blnskg FROM DUAL";
$sql 	= mysql_query($text);
$rec	= mysql_fetch_array($sql);
$kodebyr= sprintf("%03s",$nourut)."/BY-".$kdprshn."/".$rec[blnskg];


$input = "INSERT INTO pembayarancustomer(kodebayar,kodecustomer,jmlbayar,tglbayar,sistembayar,norekbank,kodebank,penerima,tglentry,userid) 
			VALUES('$kodebyr','$kdcustomer','$jmlbayar','$tglbayar','$sistembyr','$norektujuan','$banktujuan','$pemilikrek',SYSDATE(),'$username')";	
mysql_query($input);

$totrpbayar = $jmlbayar;

$text 	= "SELECT a.kodetrx,b.noinvoice FROM checkbox_temp a LEFT JOIN ordersewa b ON b.kodeorder=a.kodetrx WHERE a.userid='$username' ORDER BY b.tglorder ASC";					
$s 		= mysql_query($text);	
while($r = mysql_fetch_array($s)){	
	$kode = $r[kodetrx];	
	$nota = $r[noinvoice];	
	
	$text	= "SELECT SUM(jmlrp)*-1 AS sisahutang FROM pelunasanpiutang WHERE kodetrx='$kode'";
	$sql 	= mysql_query($text);
	$rec	= mysql_fetch_array($sql);
	$rptag 	= $rec[sisahutang];
	
	if($totrpbayar<$rptag){
		$jmlbayar = $totrpbayar;
		$totrpbayar = 0;
	}else{
		$jmlbayar = $rptag;	
		$totrpbayar = $totrpbayar - $jmlbayar;
	}
	
	if($jmlbayar>0){
		$input = "INSERT INTO pelunasanpiutang(kodetrx,kodeorder,noinvoice,jmlrp,kodecustomer) VALUES('$kodebyr','$kode','$nota','$jmlbayar','$kdcustomer')";	
		mysql_query($input);
		
		$text	= "SELECT SUM(jmlrp) AS sisahutang FROM pelunasanpiutang WHERE kodeorder='$kode'";
		$sql 	= mysql_query($text);
		$rec	= mysql_fetch_array($sql);
		
		if($rec[sisahutang]==0){
			$update = "UPDATE ordersewa SET kdlunas='1' WHERE kodeorder='$kode'";	
			mysql_query($update);
		}
		
		$result = "Simpan data sukses";
	}	
}

$del = "DELETE FROM checkbox_temp WHERE userid='$username'";	
mysql_query($update);

echo $result;

?>