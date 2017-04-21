<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";

$username = $_SESSION[namauser];

$text 	= "SELECT kodetrx FROM lintasform WHERE userid='$username'";
$query 	= mysql_query($text);
$rs 	= mysql_fetch_array($query);
$kode 	= $rs[kodetrx];

$text	= "SELECT a.kodeorder,DATE_FORMAT(a.estimasisampai,'%d/%m/%Y') AS tglestimasi,a.kode_customer,DATE_FORMAT(a.tglbongkar,'%d/%m/%Y') AS tglbongkar,
			DATE_FORMAT(a.tglmuat,'%d/%m/%Y') AS tgl,b.nama_customer AS customer,b.alamat AS alamatcust,a.armada AS kodearmada,a.jml,a.kodesatuan,a.biayasewa,a.sistemsewa,
			CONCAT(d.namaarmada,' (',REPLACE(d.nopol,'-',' '),')') AS armada,CONCAT(e.nama,' - ',f.nama) AS tujuan, a.noinvoice 
			FROM ordersewa a 
			LEFT JOIN customer b ON b.kode_customer=a.kode_customer
			LEFT JOIN armada d ON d.nopol=a.armada
			LEFT JOIN kota e ON e.kode=a.kotaasal
			LEFT JOIN kota f ON f.kode=a.kotatujuan
			WHERE a.kodeorder='$kode' ";
			
$sql 	= mysql_query($text);
$jmlrec	= mysql_num_rows($sql);	

if($jmlrec>0){	
	while($r=mysql_fetch_array($sql)){		
		
		$data['ada']			= $jmlrec;
		$data['kodeorder']		= $r[kodeorder];
		$data['noinvoice']		= $r[noinvoice];
		$data['kodearmada']		= $r[kodearmada];
		$data['armada']			= $r[armada];
		$data['tujuan']			= $r[tujuan];
		$data['tgl']			= $r[tgl];
		$data['tglestimasi']	= $r[tglestimasi];
		$data['tglbongkar']		= $r[tglbongkar];
		$data['kode_customer']	= $r[kode_customer];
		$data['customer']		= $r[customer];
		$data['alamatcust']		= $r[alamatcust];
		$data['suratjalan']		= $r[suratjalan];
		$data['jml']			= $r[jml];		
		$data['kodesatuan']		= $r[kodesatuan];
		$data['biayasewa']		= $r[biayasewa];
		$data['sistemsewa']		= $r[sistemsewa];
		$data['suratjalan']		= $r[suratjalan];
		echo json_encode($data);
	}		
}else{
		$data['ada']			= $jmlrec;
		$data['kodearmada']		= '';
		$data['noinvoice']		= '';
		$data['armada']			= '';
		$data['biayasewa']		= '';
		$data['tujuan']			= '';
		$data['tglmuat']		= '';
		$data['tglestimasi']	= '';
		$data['tglbongkar']		= '';
		$data['kode_customer']	= '';
		$data['customer']		= '';
		$data['alamatcust']		= '';
		$data['jml']			= '';
		$data['kodesatuan']		= '';
		$data['sistemsewa']		= '';
		$data['suratjalan']		= '';
		echo json_encode($data);
}
	
?>