<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$tglorder		= $_POST[tglorder];
$kodecustomer	= $_POST[kodecustomer];
$kodebarang		= $_POST[kodebarang];
$jml			= $_POST[jml];
$tbiaya			= format_komadua_sql($_POST[tbiaya]);
$ket			= $_POST[ket];
$kode			= $_POST[kode];
$username 		= $_SESSION[namauser];

$tglorder = date('Y-m-d', strtotime(str_replace('-', '/', $tglorder)));
$tbiaya		= preg_replace("/[^0-9]/","", $tbiaya);
	
if(empty($jml) or $jml==0){
	$jml = '(NULL)';
}


if($ada==0){
		$text	= "SELECT MAX(LEFT(kodeorder,3)) AS nourut FROM orderproduk WHERE DATE_FORMAT(tglorder,'%Y-%m')=DATE_FORMAT(SYSDATE(),'%Y-%m')";
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
	
	$text	= "SELECT DATE_FORMAT(SYSDATE(),'%m%Y') AS blnskg FROM DUAL";
	$sql	= mysql_query($text);
	$rec 	= mysql_fetch_array($sql);
	$blnskg = $rec[blnskg];

	$kode 		= sprintf("%03s",$nourut).'/PO/'.$blnskg;
	//biayatot
	
	$biaya	= $jml*$tbiaya;
	
	//validasi stok
	$text		= "SELECT jml FROM barang WHERE kode_barang = '$kodebarang'";
	$sql		= mysql_query($text);
	$r			= mysql_fetch_array($sql);
	$cek		= $r[jml];
	
	if($cek==0){
	echo"<h4 class='text-danger'>Tidak Ada Stok Untuk Barang ini. Segera buat SPK</h4>";
	}
	elseif($val = $_POST[jml]>$cek){
		echo "<h4>Stok tidak cukup. Segera Buat SPK &nbsp; Stok barang&nbsp;" .$cek. "&nbsp;Kg</h4>";
	}else{
	$input = "INSERT INTO orderproduk(
							kodeorder,
							kode_customer,
							tglorder,
							kode_barang,
							jml,
							tbiaya,
							totbiaya,
							ket,
							tglentry,
							userid
							)
				VALUES('$kode', 
						'$kodecustomer',
						'$tglorder',
						'$kodebarang',
						'$jml',
						'$tbiaya',
						'$biaya',
						'$ket',
						SYSDATE(),
						'$username')";
	mysql_query($input);
	
var_dump($input);die;
	
	echo "<h4>Simpan Data Sukses,</p> No Purchase Order Anda : <h4>".$kode."</h4>";
	
}}else{
	
	echo "gagal";
}	


?>