<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$tglkirim		= $_POST[tglkirim];
$kodeorder		= $_POST[kodeorder];
$kodepers		= $_POST[kodeperusahaan];
$kend			= $_POST[kendaraan];
$jml			= $_POST[jml];
$nopol			= $_POST[nopol];
$ket			= $_POST[ket];
$kode			= $_POST[kode];
$username 		= $_SESSION[namauser];

$tglkirim = date('Y-m-d', strtotime(str_replace('-', '/', $tglkirim)));




if($ada==0){
		$text	= "SELECT MAX(LEFT(kodekirim,2)) AS nourut FROM pengiriman WHERE DATE_FORMAT(tglkirim,'%Y-%m')=DATE_FORMAT(SYSDATE(),'%Y-%m')";
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
	
	//kondisi untuk kodekirim
	 if($_POST[kodeperusahaan]==PJSG){
		$kode 		= sprintf("%02s",$nourut).'/SJ - IS/'.$blnskg;
	 }else{
		$kode 		= sprintf("%02s",$nourut).'/SJ - SMN/'.$blnskg;
	 }

	//biaya
	$text="SELECT
				a.tbiaya*$jml as subbiaya
			FROM
				orderproduk a
			LEFT JOIN pengiriman b ON b.kodeorder=a.kodeorder
			WHERE a.kodeorder='$kodeorder'";
	$sql 	= mysql_query($text);
	$r	 	= mysql_fetch_array($sql);
	$harga	= $r[subbiaya];
		
	//get kode_barang
	$text = "SELECT kode_barang FROM orderproduk WHERE kodeorder = '$kodeorder'";
	$sql		= mysql_query($text);
	$r			= mysql_fetch_array($sql);
	$kodebarang	= $r[kode_barang];

	//	validasi jumlah pengiriman
	$text		= "SELECT
						a.jml - SUM(
							CASE
							WHEN b.jml IS NULL THEN
								0
							ELSE
								b.jml
							END
						) as jml
					FROM
						orderproduk a
					LEFT JOIN pengiriman b ON b.kodeorder = a.kodeorder
					WHERE
						a.kodeorder = '$kodeorder'
					GROUP BY
						a.kodeorder";
	$sql		= mysql_query($text);
	$r			= mysql_fetch_array($sql);
	$cek		= $r[jml];
	if($val = $_POST[jml]>$cek){
		echo "<h4>Jumlah Pengiriman melebihi Sisa Pengiriman. Sisa Pengiriman &nbsp;" .$cek. "&nbsp;Kg</h4>";
	}else{
	$input = "INSERT INTO pengiriman(
							kodekirim,
							kodeorder,
							kode_barang,
							kodeperusahaan,
							kendaraan,
							jml,
							biaya,
							nopol,
							tglkirim,
							ket,
							tglentry,
							userid,
							kdterima
							)
				VALUES('$kode', 
						'$kodeorder',
						'$kodebarang',
						'$kodepers',
						'$kend',
						'$jml',
						'$harga',
						'$nopol',
						'$tglkirim',
						'$ket',
						SYSDATE(),
						'$username',
						'1')";
	mysql_query($input);
//var_dump($input);die;
	
	echo "<h4>Simpan Data Sukses,</p> No Pengiriman Anda : <h4>".$kode."</h4>";
	
}}else{
	
	echo "gagal";
}	


?>