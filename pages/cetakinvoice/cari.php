<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode 	= $rs[kodetrx];

$text	= "SELECT a.kodeorder,DATE_FORMAT(a.tglmuat,'%d/%m/%Y') AS tglmuat,b.nama_perusahaan AS customer,d.namaarmada,CONCAT(d.namaarmada,' (',REPLACE(d.nopol,'-',' '),')') AS armada,
			DATE_FORMAT(a.estimasisampai,'%d/%m/%Y') AS tglsampai,e.nama AS kotaasal,f.nama AS kotatujuan,c.nama AS marketing FROM ordersewa a 
			LEFT JOIN customer b ON b.kode_customer=a.kode_customer
			LEFT JOIN karyawan c ON c.nik=a.marketing
			LEFT JOIN armada d ON d.nopol=a.armada
			LEFT JOIN kota e ON e.kode=a.kotaasal 
			LEFT JOIN kota f ON f.kode=a.kotatujuan
			 WHERE a.kodeorder='$kode' ";
			
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		
		$data['ada']		= $jmlrec;
		$data['armada']		= $r[armada];
		$data['tglmuat']	= $r[tglmuat];
		$data['kotaasal']	= $r[kotaasal];
		$data['kotatujuan']	= $r[kotatujuan];
		$data['tglbongkar']		= $r[tglbongkar];
		$data['customer']	= $r[customer];
		$data['namabrg']		= $r[namabrg];	
		$data['kodesatuan']		= $r[kodesatuan];
		$data['biayasewa']		= $r[biayasewa];
		$data['marketing']		= $r[marketing];
		echo json_encode($data);
	}		
}else{
		$data['ada']		= $jmlrec;
		$data['armada']		= '';
		$data['tglmuat']	= '';
		$data['kotaasal']	= '';
		$data['kotatujuan']	= '';
		$data['tglsampai']	= '';
		$data['nama_perusahaan']	= '';
		$data['namabrg']		= '';
		$data['kodesatuan']	= '';
		$data['biayasewa']	= '';
		$data['marketing']	= '';
		echo json_encode($data);	
}
	
?>