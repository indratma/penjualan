<?php
session_start();
include "../../inc/inc.koneksi.php";
include "../../inc/fungsi_hdt.php";
include "../../inc/fungsi_tanggal.php";
include "../../inc/fungsi_koma.php";

$tglorder		= $_POST[tglorder];
$kodecustomer	= $_POST[kodecustomer];
$namabrg		= strtoupper($_POST[namabrg]);
$jml			= $_POST[jml];
$tbiaya			= format_komadua_sql($_POST[tbiaya]);
$ket			= $_POST[ket];
$kode			= ($_POST[kode]);
$username 		= $_SESSION[namauser];

$tgl = substr($tglorder,0,2);
$bln = substr($tglorder,3,2);
$thn = substr($tglorder,6,4);

$tglorder = $thn.'-'.$bln.'-'.$tgl;


$text		= "SELECT kodetrx FROM lintasform WHERE userid='$username' AND idtrx='neworder'";
$sql		= mysql_query($text);
$ada		= mysql_num_rows($sql);
$rec 		= mysql_fetch_array($sql);
$kodetrx	= $rec[kodetrx];

	$upd	= "UPDATE orderproduk SET kode_customer='$kodecustomer',
								tglorder		='$tglorder',
								namabrg			='$namabrg',
								jml				='$jml',
								tbiaya			='$tbiaya',
								ket				='$ket',
								userid			='$username',
								ket				='$ket'
					WHERE kodeorder= '$kodetrx'";
	mysql_query($upd);
	var_dump($upd);die;
	$txt	="DELETE FROM logperjalanan WHERE kodeorder='$kodetrx'";
	mysql_query($txt);
	
	$txt	="SELECT datefield AS tgl FROM calendar WHERE datefield>='$tglmuat' AND datefield<='$tglbongkar'";
	$q		= mysql_query($txt);				
	while($rs = mysql_fetch_array($q)){
		$inputx = "INSERT INTO logperjalanan(kodeorder,nopol,tgl)
					VALUES('$kodetrx','$kodearmada','$rs[tgl]')";
		mysql_query($inputx);
	}
	
	$del = "DELETE FROM combobox WHERE userid='$username'";
	mysql_query($del);

	$del = "DELETE FROM lintasform WHERE userid='$username'";
	mysql_query($del);
	
	echo "<h4>Data sukses di ubah.</h4>";
	
?>